#!/usr/bin/env node

/**
 * Git Automatique
 * 
 * Main entry point for the Git automation script
 * This script automates the Git workflow by monitoring changes in the codebase
 * and automatically managing commits, milestones, issues, and pushes.
 */

// Import the main application from the src directory
import './src/index.js';

// This file serves as the main entry point and delegates to the implementation in src/
// This allows users to run the application with `node index.js` from the root directory
