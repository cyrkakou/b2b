#!/usr/bin/env node

/**
 * Git Automation Script
 *
 * This script automates the Git workflow by monitoring changes in the codebase
 * and automatically managing commits, milestones, issues, and pushes.
 *
 * It follows a service-oriented architecture with clear separation of concerns.
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';
import { dirname } from 'path';
import chokidar from 'chokidar';
import dotenv from 'dotenv';
import { GitHubService, GitService } from './service.js';
import logger, { initLogger } from './logger.js';

// Set up __dirname equivalent for ES modules
const __dirname = dirname(fileURLToPath(import.meta.url));

/**
 * TaskParser class for handling tasks.md file parsing
 */
class TaskParser {
  /**
   * Parse tasks.md file content
   * @param {string} content - Content of tasks.md file
   * @returns {Array} - List of parsed tasks
   */
  static parseTasks(content) {
    const tasks = [];
    const lines = content.split('\n');

    let currentTask = null;
    let currentSubtask = null;

    for (const line of lines) {
      // Skip empty lines
      if (!line.trim()) continue;

      // Detect milestones (# Title)
      if (line.startsWith('# ')) {
        if (currentTask) {
          tasks.push(currentTask);
        }

        currentTask = {
          type: 'milestone',
          title: line.substring(2).trim(),
          description: '',
          subtasks: [],
        };
        currentSubtask = null;
      }
      // Detect issues (## Title)
      else if (line.startsWith('## ')) {
        if (currentTask) {
          currentSubtask = {
            type: 'issue',
            title: line.substring(3).trim(),
            description: '',
          };
          currentTask.subtasks.push(currentSubtask);
        } else {
          if (currentSubtask) {
            tasks.push(currentSubtask);
          }

          currentSubtask = {
            type: 'issue',
            title: line.substring(3).trim(),
            description: '',
          };
          currentTask = null;
        }
      }
      // Add to description
      else {
        if (currentSubtask) {
          currentSubtask.description += line.trim() + '\n';
        } else if (currentTask) {
          currentTask.description += line.trim() + '\n';
        }
      }
    }

    // Add the last task
    if (currentTask) {
      tasks.push(currentTask);
    } else if (currentSubtask) {
      tasks.push(currentSubtask);
    }

    return tasks;
  }
}

/**
 * GitAutomation class - Main application class
 */
class GitAutomation {
  /**
   * Initialize the Git Automation application
   */
  constructor() {
    // Load environment variables
    dotenv.config();

    // Initialize configuration
    this.config = this.loadConfig();

    // Initialize logger with configuration
    initLogger(this.config);

    // Initialize services
    this.gitService = new GitService(this.config.repositoryPath);
    this.githubService = new GitHubService(
      process.env.GITHUB_TOKEN || this.config.githubToken,
      this.config.githubOwner,
      this.config.githubRepo
    );

    // Initialize timeout reference
    this.commitTimeout = null;
  }

  /**
   * Load configuration from config.json
   * @returns {Object} - Configuration object
   */
  loadConfig() {
    try {
      const configPath = path.join(__dirname, 'config.json');
      logger.debug(`Loading configuration from ${configPath}`);
      const config = JSON.parse(fs.readFileSync(configPath, 'utf8'));

      // Resolve relative paths to absolute paths
      if (config.repositoryPath && !path.isAbsolute(config.repositoryPath)) {
        config.repositoryPath = path.resolve(__dirname, config.repositoryPath);
      }

      if (config.monitorPath && !path.isAbsolute(config.monitorPath)) {
        config.monitorPath = path.resolve(__dirname, config.monitorPath);
      } else if (!config.monitorPath) {
        config.monitorPath = config.repositoryPath;
      }

      return config;
    } catch (error) {
      logger.error(`Failed to load configuration: ${error.message}`);
      process.exit(1);
    }
  }

  /**
   * Create issues from tasks.md file
   * @returns {Promise<Array>} - List of created issue IDs
   */
  async createIssuesFromTasksFile() {
    try {
      const tasksPath = path.join(__dirname, 'tasks.md');
      logger.debug(`Reading tasks from ${tasksPath}`);

      const tasksContent = fs.readFileSync(tasksPath, 'utf8');
      const tasks = TaskParser.parseTasks(tasksContent);
      const issues = [];

      logger.info(`Creating issues from tasks.md (${tasks.length} tasks found)`);

      for (const task of tasks) {
        if (task.type === 'milestone') {
          const milestoneId = await this.githubService.createMilestone(task.title, task.description || '');

          if (milestoneId) {
            // Create issues associated with this milestone
            for (const subtask of task.subtasks || []) {
              const issueId = await this.githubService.createIssue(subtask.title, subtask.description || '', milestoneId);
              if (issueId) {
                issues.push(issueId);
              }
            }
          }
        } else if (task.type === 'issue') {
          const issueId = await this.githubService.createIssue(task.title, task.description || '', null);
          if (issueId) {
            issues.push(issueId);
          }
        }
      }

      logger.info(`${issues.length} issues created from tasks.md`);
      return issues;
    } catch (error) {
      logger.error(`Error reading tasks.md file: ${error.message}`);
      return [];
    }
  }

  /**
   * Create issues from file changes
   * @param {Array} diffs - List of changed files
   * @returns {Promise<Array>} - List of created issue IDs
   */
  async createIssuesFromChanges(diffs) {
    if (!this.config.autoIssue) {
      logger.debug('Auto issue creation is disabled');
      return [];
    }

    // If strategy is based on tasks file, use that method
    if (this.config.strategy === 'tasksFile') {
      logger.debug('Using tasksFile strategy for issue creation');
      return this.createIssuesFromTasksFile();
    }

    // Otherwise, use the algorithm to determine issues
    logger.debug('Using algorithm strategy for issue creation');
    const issues = [];
    const type = this.gitService.determineCommitType(diffs);

    // Group files by folder
    const folderGroups = diffs.reduce((acc, file) => {
      const folder = file.split('/')[0] || 'root';
      if (!acc[folder]) acc[folder] = [];
      acc[folder].push(file);
      return acc;
    }, {});

    // Create an issue for each group of files
    for (const [folder, files] of Object.entries(folderGroups)) {
      if (files.length > 0) {
        const title = `${type}: Changes in ${folder}`;
        const body = `Modified files:\n${files.map(f => `- ${f}`).join('\n')}`;

        const milestoneTitle = `Sprint ${new Date().toISOString().slice(0, 10)}`;
        const milestoneDesc = `Automatic milestone for changes on ${new Date().toISOString().slice(0, 10)}`;

        const milestoneId = await this.githubService.createMilestone(milestoneTitle, milestoneDesc);

        if (milestoneId) {
          const issueId = await this.githubService.createIssue(title, body, milestoneId);
          if (issueId) {
            issues.push(issueId);
          }
        }
      }
    }

    return issues;
  }

  /**
   * Handle repository changes
   */
  async handleChanges() {
    try {
      logger.debug('Checking for repository changes...');

      // Check repository status
      const status = await this.gitService.getStatus();

      if (!status) {
        logger.error('Failed to get repository status');
        return;
      }

      if (status.files.length === 0) {
        logger.debug('No changes detected in the repository');
        return;
      }

      logger.info(`Changes detected in ${status.files.length} files`);

      // Get list of modified files
      const diffs = status.files.map(file => file.path);
      logger.debug(`Modified files: ${JSON.stringify(diffs)}`);

      // Create issues if enabled
      let issues = [];
      if (this.config.autoIssue) {
        logger.info('Automatic issue creation enabled, analyzing changes...');
        issues = await this.createIssuesFromChanges(diffs);
      }

      // Create commit if enabled
      if (this.config.autoCommit) {
        logger.info('Automatic commit enabled, preparing commit...');

        // Add all modified files
        logger.debug('Adding files to staging...');
        const addResult = await this.gitService.addFiles('.');
        if (!addResult) {
          logger.error('Failed to add files to staging');
          return;
        }
        logger.debug('Files successfully added to staging');

        // Generate commit message
        const commitMessage = this.gitService.generateCommitMessage(diffs);
        logger.debug(`Generated commit message: ${commitMessage}`);

        // Create commit
        logger.debug('Creating commit...');
        const commitResult = await this.gitService.commit(commitMessage);
        if (!commitResult) {
          logger.error('Failed to create commit');
          return;
        }

        logger.info(`Commit created: ${commitMessage}`);

        // Push if enabled
        if (this.config.autoPush) {
          logger.info(`Automatic push enabled, pushing to ${this.config.branch}...`);

          // Ensure we have the correct branch
          const branch = this.config.branch || 'main';

          logger.debug(`Pushing changes to origin/${branch}...`);
          const pushResult = await this.gitService.push('origin', branch);

          if (pushResult) {
            logger.info(`Push completed to origin/${branch}`);
          } else {
            logger.error(`Failed to push changes to origin/${branch}`);
          }
        } else {
          logger.info('Automatic push is disabled. Changes committed but not pushed.');
        }

        // Handle issues if enabled
        if (this.config.autoIssue && issues.length > 0) {
          // Extract issue numbers to close from commit message
          const issueNumbersToClose = this.githubService.extractIssueNumbers(commitMessage);

          // Close issues if necessary
          if (issueNumbersToClose.length > 0) {
            logger.info(`Closing issues: ${issueNumbersToClose.join(', ')}`);
            for (const issueNumber of issueNumbersToClose) {
              await this.githubService.closeIssue(issueNumber);
            }
          }
        }
      } else {
        logger.info('Automatic commit is disabled. Changes detected but not committed.');
      }
    } catch (error) {
      logger.error(`Error processing changes: ${error.message}`);
      logger.debug(`Stack trace: ${error.stack}`);
    }
  }

  /**
   * Start watching the repository
   */
  startWatching() {
    const pathToWatch = this.config.monitorPath || this.config.repositoryPath;
    logger.info(`Starting repository monitoring: ${pathToWatch}`);
    logger.debug(`Logging configuration: level=${this.config.logging.level}, file=${this.config.logging.filePath}`);

    // Build ignore patterns
    const ignoredPatterns = [
      /(^|[\/\\])\../,  // Hidden files
    ];

    // Add custom ignore patterns from config
    if (Array.isArray(this.config.ignorePaths)) {
      for (const ignorePath of this.config.ignorePaths) {
        ignoredPatterns.push(new RegExp(ignorePath));
      }
    } else {
      // Default ignore patterns
      ignoredPatterns.push(/node_modules/);
      ignoredPatterns.push(/.git/);
      ignoredPatterns.push(/logs/);
    }

    logger.debug(`Monitoring path: ${pathToWatch}`);
    logger.debug(`Ignored patterns: ${ignoredPatterns.map(p => p.toString()).join(', ')}`);

    // Configure the watcher with more aggressive polling
    const watcher = chokidar.watch(pathToWatch, {
      ignored: ignoredPatterns,
      persistent: true,
      ignoreInitial: false,  // Process existing files on startup
      usePolling: true,      // Use polling for more reliable detection
      interval: 1000,        // Poll every second
      binaryInterval: 3000,  // Poll binary files every 3 seconds
      awaitWriteFinish: {
        stabilityThreshold: 1000,
        pollInterval: 100,
      },
      alwaysStat: true,      // Always get stats for better change detection
    });

    logger.debug(`Monitoring options: polling=${this.config.pollingInterval}ms`);

    // Change events
    const events = ['add', 'change', 'unlink'];

    // Handle events
    events.forEach(event => {
      watcher.on(event, filePath => {
        logger.info(`File ${event}: ${filePath}`);

        // Wait a bit to avoid too frequent commits
        clearTimeout(this.commitTimeout);
        this.commitTimeout = setTimeout(() => {
          logger.debug(`Polling delay elapsed, processing changes...`);
          this.handleChanges();
        }, this.config.pollingInterval || 2000);
      });
    });

    // Handle errors
    watcher.on('error', error => {
      logger.error(`Monitoring error: ${error}`);
      logger.debug(`Stack trace: ${error.stack}`);
    });

    // Handle ready event
    watcher.on('ready', () => {
      logger.info('Initial scan complete. Monitoring active. Press Ctrl+C to stop.');

      // Do an initial check for changes
      setTimeout(() => {
        logger.debug('Performing initial check for changes...');
        this.handleChanges();
      }, 1000);
    });

    // Handle all events (for debugging)
    watcher.on('all', (event, path) => {
      logger.debug(`Watcher event: ${event} - ${path}`);
    });
  }

  /**
   * Start the application
   */
  async start() {
    try {
      // Log application start
      logger.info('Initializing Git automation script');

      // Load package.json for version info
      const packagePath = path.join(__dirname, 'package.json');
      const packageJson = JSON.parse(fs.readFileSync(packagePath, 'utf8'));
      logger.debug(`Script version: ${packageJson.version}`);

      // Check if repository is valid
      const isRepo = await this.gitService.checkIsRepo();

      if (!isRepo) {
        logger.error(`The specified path is not a valid Git repository: ${this.config.repositoryPath}`);
        process.exit(1);
      }

      logger.info(`Valid Git repository: ${this.config.repositoryPath}`);

      // Start monitoring
      this.startWatching();
    } catch (error) {
      logger.error(`Error starting application: ${error.message}`);
      logger.debug(`Stack trace: ${error.stack}`);
      process.exit(1);
    }
  }
}

// Create and start the application
const app = new GitAutomation();
app.start();