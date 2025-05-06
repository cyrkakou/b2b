#!/usr/bin/env node

/**
 * Git Automatique
 *
 * Main entry point for the Git automation script
 * This script automates the Git workflow by monitoring changes in the codebase
 * and automatically managing commits, milestones, issues, and pushes.
 */

// Process command-line arguments
const args = process.argv.slice(2);

// Show help if requested
if (args.includes('--help') || args.includes('-h')) {
  console.log(`
Git Automatique - Automated Git Repository Management

Usage: node index.js [options]

Options:
  --help, -h       Show this help message
  --version, -v    Show version information
  --config <path>  Specify a custom config file path
  --monitor <path> Specify a path to monitor
  --no-push        Disable automatic pushing
  --no-commit      Disable automatic committing
  --no-issue       Disable automatic issue creation

Examples:
  node index.js                     Start with default configuration
  node index.js --no-push           Start without automatic pushing
  node index.js --config custom.json Start with a custom config file

For more information, see the README.md file.
  `);
  process.exit(0);
}

// Show version if requested
if (args.includes('--version') || args.includes('-v')) {
  // Read package.json for version info
  import('fs').then(fs => {
    import('path').then(path => {
      const packagePath = path.join(process.cwd(), 'package.json');
      const packageJson = JSON.parse(fs.readFileSync(packagePath, 'utf8'));
      console.log(`Git Automatique v${packageJson.version}`);
      process.exit(0);
    });
  });
} else {
  // Import the main application from the src directory
  import('./src/index.js');
}

// This file serves as the main entry point and delegates to the implementation in src/
// This allows users to run the application with `node index.js` from the root directory
