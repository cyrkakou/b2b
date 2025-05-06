/**
 * Module de logging pour le script d'automatisation Git
 * Utilise Winston pour gérer les logs avec différents niveaux et destinations
 */

import fs from 'fs';
import path from 'path';
import { createLogger, format, transports } from 'winston';
import 'winston-daily-rotate-file';
import dotenv from 'dotenv';

// Load environment variables
dotenv.config();

/**
 * Creates and configures a logger instance
 * @param {Object} config - Configuration object
 * @returns {Object} - Configured Winston logger
 */
function createLoggerInstance(config) {
  // Configuration par défaut du logging si non spécifiée dans config.json
  const defaultLoggingConfig = {
    enabled: true,
    level: 'info',
    filePath: './logs/automation-%DATE%.log',
    maxFiles: '14d',
    consoleLevel: 'info'
  };

  // Fusionner la configuration avec les valeurs par défaut
  const configLogging = config.logging || {};
  const loggingConfig = {
    ...defaultLoggingConfig,
    ...configLogging,
    // Priorité aux variables d'environnement si définies
    enabled: process.env.LOG_ENABLED !== undefined ? process.env.LOG_ENABLED === 'true' : (configLogging.enabled !== undefined ? configLogging.enabled : defaultLoggingConfig.enabled),
    level: process.env.LOG_LEVEL || configLogging.level || defaultLoggingConfig.level,
    filePath: process.env.LOG_FILE_PATH || configLogging.filePath || defaultLoggingConfig.filePath,
  };

  // Créer le dossier de logs s'il n'existe pas
  const logsDir = path.dirname(loggingConfig.filePath);
  if (!fs.existsSync(logsDir)) {
    fs.mkdirSync(logsDir, { recursive: true });
  }

  // Définir les formats
  const logFormat = format.combine(
    format.timestamp({ format: 'YYYY-MM-DD HH:mm:ss' }),
    format.printf(({ level, message, timestamp }) => {
      return `[${timestamp}] ${level.toUpperCase()}: ${message}`;
    })
  );

  // Créer le logger
  const logger = createLogger({
    level: loggingConfig.level,
    format: logFormat,
    defaultMeta: { service: 'git-automation' },
    transports: [],
    exitOnError: false
  });

  // Ajouter les transports si le logging est activé
  if (loggingConfig.enabled) {
    // Transport pour la console
    logger.add(new transports.Console({
      level: loggingConfig.consoleLevel || loggingConfig.level,
      format: format.combine(
        format.colorize(),
        logFormat
      )
    }));

    // Transport pour les fichiers avec rotation
    logger.add(new transports.DailyRotateFile({
      filename: loggingConfig.filePath,
      datePattern: 'YYYY-MM-DD',
      zippedArchive: true,
      maxFiles: loggingConfig.maxFiles,
      maxSize: loggingConfig.maxSize || '20m'
    }));
  }

  // Fonction pour remplacer console.log, console.error, etc. par les fonctions de logging
  if (loggingConfig.patchConsole) {
    const originalConsole = {
      log: console.log,
      info: console.info,
      warn: console.warn,
      error: console.error,
      debug: console.debug
    };

    console.log = (...args) => {
      logger.info(args.join(' '));
      if (loggingConfig.preserveConsole) {
        originalConsole.log(...args);
      }
    };

    console.info = (...args) => {
      logger.info(args.join(' '));
      if (loggingConfig.preserveConsole) {
        originalConsole.info(...args);
      }
    };

    console.warn = (...args) => {
      logger.warn(args.join(' '));
      if (loggingConfig.preserveConsole) {
        originalConsole.warn(...args);
      }
    };

    console.error = (...args) => {
      logger.error(args.join(' '));
      if (loggingConfig.preserveConsole) {
        originalConsole.error(...args);
      }
    };

    console.debug = (...args) => {
      logger.debug(args.join(' '));
      if (loggingConfig.preserveConsole) {
        originalConsole.debug(...args);
      }
    };
  }

  return logger;
}

// Create a default logger with basic configuration
// This will be replaced with a properly configured logger once config is loaded
let logger = createLogger({
  level: 'info',
  format: format.combine(
    format.timestamp(),
    format.printf(({ level, message, timestamp }) => {
      return `[${timestamp}] ${level.toUpperCase()}: ${message}`;
    })
  ),
  transports: [new transports.Console()]
});

/**
 * Initialize the logger with configuration
 * @param {Object} config - Configuration object
 */
export function initLogger(config) {
  logger = createLoggerInstance(config);
  return logger;
}

// Export the logger
export default logger;
