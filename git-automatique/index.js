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

    // Get the current sprint milestone or create a new one
    const milestoneId = await this.githubService.getCurrentSprintMilestone();
    if (!milestoneId) {
      logger.warn('Failed to create or get milestone. Issues will be created without milestone.');
    }

    // Determine appropriate labels for the changes
    const labels = await this.githubService.determineLabelsForChanges(diffs);
    logger.debug(`Determined labels for changes: ${labels.join(', ')}`);

    // Get repository info to determine assignees
    const repoInfo = await this.githubService.getRepositoryInfo();
    let defaultAssignee = [];

    if (repoInfo && repoInfo.owner && repoInfo.owner.login) {
      defaultAssignee = [repoInfo.owner.login];
      logger.debug(`Using repository owner as default assignee: ${defaultAssignee[0]}`);
    }

    // Analyze the changes to create more meaningful issues
    const { type } = this.gitService.analyzeChanges(diffs);

    // Group files by folder with more intelligent grouping
    const folderGroups = this.groupFilesByComponent(diffs);

    // Create an issue for each group of files
    for (const [component, files] of Object.entries(folderGroups)) {
      if (files.length > 0) {
        // Create a more descriptive title
        const title = `${type}: ${files.length > 3 ? 'Multiple changes' : 'Changes'} in ${component}`;

        // Create a more detailed body with file list and change type
        const body = `## Automatic Issue for ${type} changes

### Component: ${component}

${type === 'feat' ? 'New features or enhancements' :
  type === 'fix' ? 'Bug fixes' :
  type === 'docs' ? 'Documentation updates' :
  type === 'style' ? 'Style/UI changes' :
  type === 'refactor' ? 'Code refactoring' :
  type === 'test' ? 'Test updates' :
  'Changes'} in the ${component} component.

### Modified files:
${files.map(f => `- \`${f}\``).join('\n')}

This issue was automatically created by the git-automatique system.
`;

        // Create the issue with labels and assignees
        const issueId = await this.githubService.createIssue(
          title,
          body,
          milestoneId,
          labels,
          defaultAssignee
        );

        if (issueId) {
          logger.info(`Created issue #${issueId} for changes in ${component}`);
          issues.push(issueId);
        }
      }
    }

    return issues;
  }

  /**
   * Group files by component more intelligently
   * @param {Array} diffs - List of changed files
   * @returns {Object} - Files grouped by component
   */
  groupFilesByComponent(diffs) {
    // Define common component patterns
    const componentPatterns = [
      { regex: /^(src|app)\/components\/([^\/]+)\//, group: (matches) => `${matches[1]}/components/${matches[2]}` },
      { regex: /^(src|app)\/([^\/]+)\//, group: (matches) => matches[2] },
      { regex: /^([^\/]+)\//, group: (matches) => matches[1] },
    ];

    // Group files by component
    const groups = {};

    for (const file of diffs) {
      let matched = false;

      // Try to match file to a component pattern
      for (const pattern of componentPatterns) {
        const matches = file.match(pattern.regex);
        if (matches) {
          const component = pattern.group(matches);
          if (!groups[component]) {
            groups[component] = [];
          }
          groups[component].push(file);
          matched = true;
          break;
        }
      }

      // If no pattern matched, use the first directory or 'root'
      if (!matched) {
        const parts = file.split('/');
        const component = parts.length > 1 ? parts[0] : 'root';
        if (!groups[component]) {
          groups[component] = [];
        }
        groups[component].push(file);
      }
    }

    return groups;
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

          if (pushResult.success) {
            logger.info(`Push completed to origin/${branch}`);
          } else {
            logger.error(`Failed to push changes to origin/${branch}: ${pushResult.error}`);

            // Handle secret detection
            if (pushResult.secretDetected && pushResult.blobId) {
              logger.warn(`Secret detected in commit. Blob ID: ${pushResult.blobId}`);

              // Check if handling blocked files is enabled
              if (this.config.handleBlockedFiles !== false) {
                // Create directory for reports if it doesn't exist
                const reportDir = path.resolve(
                  __dirname,
                  this.config.blockedFilesReportPath || './logs/blocked_files'
                );

                if (!fs.existsSync(reportDir)) {
                  try {
                    fs.mkdirSync(reportDir, { recursive: true });
                    logger.debug(`Created directory for blocked files reports: ${reportDir}`);
                  } catch (mkdirError) {
                    logger.error(`Failed to create directory for reports: ${mkdirError.message}`);
                  }
                }

                // Create a report file for the blocked push with timestamp
                const timestamp = new Date().toISOString().replace(/:/g, '-').replace(/\./g, '-');
                const reportPath = path.join(reportDir, `blocked_push_${timestamp}.txt`);
                const reportContent = `
Push Blocked Report
==================
Date: ${new Date().toISOString()}
Reason: GitHub Secret Detection
Blob ID: ${pushResult.blobId}
${pushResult.unblockUrl ? `Unblock URL: ${pushResult.unblockUrl}` : ''}

Error Details:
${pushResult.errorDetails || 'No detailed error information available'}
`;

                try {
                  fs.writeFileSync(reportPath, reportContent);
                  logger.info(`Created blocked push report at ${reportPath}`);
                } catch (reportError) {
                  logger.error(`Failed to create blocked push report: ${reportError.message}`);
                }

                // Try to find the file containing the secret
                const filePath = await this.gitService.findFileByBlobId(pushResult.blobId);

                if (filePath) {
                  logger.info(`Found file containing secret: ${filePath}`);

                  // Add the file to the report
                  try {
                    fs.appendFileSync(reportPath, `\nFile containing secret: ${filePath}\n`);

                    // Copy the problematic file to the report directory for analysis
                    const sourceFilePath = path.join(this.config.repositoryPath, filePath);
                    const targetFilePath = path.join(reportDir, `blocked_file_${path.basename(filePath)}`);

                    if (fs.existsSync(sourceFilePath)) {
                      fs.copyFileSync(sourceFilePath, targetFilePath);
                      logger.info(`Copied problematic file to ${targetFilePath} for analysis`);
                      fs.appendFileSync(reportPath, `\nCopy of file saved to: ${targetFilePath}\n`);
                    }

                    logger.info(`Updated report with file information`);
                  } catch (appendError) {
                    logger.error(`Failed to update report: ${appendError.message}`);
                  }

                  // Remove the file from the last commit
                  const removeResult = await this.gitService.removeFileFromLastCommit(filePath);

                  if (removeResult) {
                    logger.info(`Removed ${filePath} from last commit`);

                    // Try pushing again without the problematic file
                    logger.info(`Attempting to push again without the problematic file...`);
                    const retryPushResult = await this.gitService.push('origin', branch);

                    if (retryPushResult.success) {
                      logger.info(`Successfully pushed changes to ${branch} after removing problematic file`);

                      // Add a note to the report
                      try {
                        fs.appendFileSync(reportPath, `\nStatus: Push successful after removing this file from commit\n`);
                      } catch (appendError) {
                        logger.error(`Failed to update report: ${appendError.message}`);
                      }
                    } else {
                      logger.error(`Failed to push even after removing problematic file: ${retryPushResult.error}`);

                      // Add a note to the report
                      try {
                        fs.appendFileSync(reportPath, `\nStatus: Push still failed after removing this file\nAdditional error: ${retryPushResult.error}\n`);
                      } catch (appendError) {
                        logger.error(`Failed to update report: ${appendError.message}`);
                      }

                      // If there are multiple problematic files, try to handle them recursively
                      if (retryPushResult.secretDetected && retryPushResult.blobId && retryPushResult.blobId !== pushResult.blobId) {
                        logger.info(`Another problematic file detected. Will handle in next cycle.`);
                      }
                    }
                  } else {
                    logger.error(`Failed to remove ${filePath} from last commit`);

                    // Add a note to the report
                    try {
                      fs.appendFileSync(reportPath, `\nStatus: Failed to remove file from commit\n`);
                    } catch (appendError) {
                      logger.error(`Failed to update report: ${appendError.message}`);
                    }
                  }
                } else {
                  logger.warn(`Could not find file for blob ID ${pushResult.blobId}`);

                  // Add a note to the report
                  try {
                    fs.appendFileSync(reportPath, `\nStatus: Could not identify the specific file containing the secret\n`);
                  } catch (appendError) {
                    logger.error(`Failed to update report: ${appendError.message}`);
                  }
                }
              } else {
                logger.info(`Handling of blocked files is disabled in configuration. Skipping remediation.`);
              }
            }
          }
        } else {
          logger.info('Automatic push is disabled. Changes committed but not pushed.');
        }

        // Handle status updates
        await this.handleStatusUpdates(commitMessage, diffs, issues);
      } else {
        logger.info('Automatic commit is disabled. Changes detected but not committed.');
      }
    } catch (error) {
      logger.error(`Error processing changes: ${error.message}`);
      logger.debug(`Stack trace: ${error.stack}`);
    }
  }

  /**
   * Handle status updates based on commit message and changes
   * @param {string} commitMessage - Commit message
   * @param {Array} diffs - List of changed files
   * @param {Array} createdIssues - List of issues created for these changes
   * @returns {Promise<void>}
   */
  async handleStatusUpdates(commitMessage, diffs, createdIssues = []) {
    try {
      logger.info('Processing status updates...');

      // Extract issue numbers from commit message
      const issueNumbers = this.githubService.extractIssueNumbers(commitMessage);

      // Combine with any issues created for these changes
      const allIssues = [...new Set([...issueNumbers, ...createdIssues])];

      if (allIssues.length === 0) {
        logger.debug('No issues to update');
        return;
      }

      logger.info(`Found ${allIssues.length} issues to update: ${allIssues.join(', ')}`);

      // Get labels for the changes
      const labels = await this.githubService.determineLabelsForChanges(diffs);

      // Process each issue
      for (const issueNumber of allIssues) {
        // Get the issue to check its current state
        const issues = await this.githubService.getIssues('all', true);
        const issue = issues.find(i => i.number === issueNumber);

        if (!issue) {
          logger.warn(`Issue #${issueNumber} not found`);
          continue;
        }

        // Add a comment with the commit information
        const commentBody = `This issue was referenced in commit with message:
\`\`\`
${commitMessage}
\`\`\`

Changed files:
${diffs.map(file => `- \`${file}\``).join('\n')}`;

        await this.githubService.addIssueComment(issueNumber, commentBody);
        logger.debug(`Added comment to issue #${issueNumber}`);

        // Update the issue with additional labels
        if (labels.length > 0) {
          // Combine existing labels with new ones
          const existingLabels = issue.labels.map(label => label.name);
          const combinedLabels = [...new Set([...existingLabels, ...labels])];

          await this.githubService.updateIssue(issueNumber, { labels: combinedLabels });
          logger.debug(`Updated issue #${issueNumber} with labels: ${labels.join(', ')}`);
        }

        // Close the issue if the commit message indicates it should be closed
        if (issueNumbers.includes(issueNumber)) {
          await this.githubService.closeIssue(issueNumber);
          logger.info(`Closed issue #${issueNumber}`);

          // If this issue is part of a milestone, check if all issues in the milestone are closed
          if (issue.milestone) {
            await this.checkMilestoneCompletion(issue.milestone.number);
          }
        }
      }
    } catch (error) {
      logger.error(`Failed to handle status updates: ${error.message}`);
    }
  }

  /**
   * Check if a milestone is complete and close it if all issues are closed
   * @param {number} milestoneNumber - Milestone number to check
   * @returns {Promise<void>}
   */
  async checkMilestoneCompletion(milestoneNumber) {
    try {
      logger.debug(`Checking completion status of milestone #${milestoneNumber}`);

      // Get all issues for this milestone
      const issues = await this.githubService.getIssues('all', true);
      const milestoneIssues = issues.filter(issue =>
        issue.milestone && issue.milestone.number === milestoneNumber
      );

      // If there are no issues, don't close the milestone
      if (milestoneIssues.length === 0) {
        logger.debug(`No issues found for milestone #${milestoneNumber}`);
        return;
      }

      // Check if all issues are closed
      const openIssues = milestoneIssues.filter(issue => issue.state === 'open');

      if (openIssues.length === 0) {
        logger.info(`All issues in milestone #${milestoneNumber} are closed. Closing milestone.`);
        await this.githubService.closeMilestone(milestoneNumber);
        logger.info(`Closed milestone #${milestoneNumber}`);
      } else {
        logger.debug(`Milestone #${milestoneNumber} has ${openIssues.length} open issues. Not closing.`);
      }
    } catch (error) {
      logger.error(`Failed to check milestone completion: ${error.message}`);
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