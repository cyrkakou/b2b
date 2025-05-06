# Git Automatique

Ce script Node.js automatise entièrement le workflow Git en surveillant les changements dans la codebase et en gérant automatiquement les commits, milestones, issues et pushes.

## Fonctionnalités

- ✅ **Surveillance continue** des changements dans la codebase
- ✅ **Auto Commit**: Création automatique des commits avec messages intelligents et descriptifs
- ✅ **Auto Push**: Push automatique vers le dépôt distant
- ✅ **Auto Milestone**: Création et gestion automatique des milestones avec dates d'échéance
- ✅ **Auto Issue**: Création automatique des issues basées sur les changements de fichiers
- ✅ **Auto Status Update**: Mise à jour automatique du statut des issues basée sur les messages de commit
- ✅ **Smart Commit Messages**: Génération de messages de commit descriptifs basés sur l'analyse des fichiers
- ✅ **Intelligent Labeling**: Application automatique d'étiquettes appropriées aux issues
- ✅ **Blocked Files Handling**: Détection et gestion des fichiers qui bloquent les pushes (ex: fichiers avec secrets)
- ✅ **Rapports détaillés** sur les problèmes de push
- ✅ **Deux stratégies** pour la détermination des milestones et issues:
  - Algorithme intelligent qui analyse les changements
  - Fichier tasks.md qui spécifie les tâches

## Prérequis

- Node.js (version 18 ou supérieure)
- Un dépôt Git initialisé
- Un token GitHub avec les permissions appropriées

## Installation

1. Clonez ce dépôt ou copiez les fichiers dans votre projet :

   ```bash
   git clone https://github.com/votre-nom-utilisateur/git-automation-script.git
   cd git-automation-script
   ```

2. Installez les dépendances :

   ```bash
   npm install
   ```

3. Configurez le script en modifiant le fichier `config.json` selon vos besoins.

4. Créez un fichier `.env` à la racine du projet et ajoutez votre token GitHub :

   ```env
   GITHUB_TOKEN=votre_token_github
   ```

## Configuration

Le fichier `config.json` contient les paramètres suivants :

```json
{
  "repositoryPath": "/chemin/vers/votre/projet",
  "monitorPath": "/chemin/vers/dossier/a/surveiller",
  "githubOwner": "votre-nom-utilisateur",
  "githubRepo": "https://github.com/votre-nom-utilisateur/nom-du-repo.git",
  "githubToken": "",
  "branch": "main",
  "autoCommit": true,
  "autoIssue": true,
  "autoMilestone": true,
  "autoPush": true,
  "strategy": "algorithm",
  "pollingInterval": 2000,
  "handleBlockedFiles": true,
  "blockedFilesReportPath": "./logs/blocked_files",
  "ignorePaths": [
    "node_modules",
    ".git",
    "logs",
    "git-automatique"
  ],
  "commitConvention": {
    "types": ["feat", "fix", "docs", "style", "refactor", "test", "chore", "perf", "ci"],
    "defaultType": "feat"
  },
  "logging": {
    "enabled": true,
    "level": "debug",
    "consoleLevel": "debug",
    "filePath": "./logs/automation-%DATE%.log",
    "maxFiles": "14d",
    "maxSize": "20m",
    "patchConsole": true,
    "preserveConsole": true
  }
}
```

### Paramètres

- `repositoryPath` : Chemin absolu ou relatif vers votre dépôt Git local
- `monitorPath` : Chemin du dossier à surveiller (si différent du dépôt Git)
- `githubOwner` : Nom d'utilisateur GitHub du propriétaire du dépôt
- `githubRepo` : URL complète ou nom du dépôt GitHub
- `githubToken` : Token GitHub (préférez utiliser le fichier .env pour des raisons de sécurité)
- `branch` : Branche sur laquelle pousser les changements
- `autoCommit` : Activer/désactiver la création automatique des commits
- `autoIssue` : Activer/désactiver la création automatique des issues
- `autoMilestone` : Activer/désactiver la création automatique des milestones
- `autoPush` : Activer/désactiver le push automatique
- `strategy` : Stratégie pour la détermination des milestones et issues (`algorithm` ou `tasksFile`)
- `pollingInterval` : Intervalle en millisecondes entre la détection d'un changement et la création d'un commit
- `handleBlockedFiles` : Activer/désactiver la gestion des fichiers bloqués lors du push
- `blockedFilesReportPath` : Chemin où stocker les rapports de fichiers bloqués
- `ignorePaths` : Liste des chemins à ignorer lors de la surveillance
- `commitConvention` : Configuration de la convention de nommage des commits

## Utilisation

### Démarrer le script

```bash
node index.js
```

Le script commencera à surveiller les changements dans votre dépôt et à automatiser le workflow Git selon la configuration spécifiée.

### Utilisation du fichier tasks.md

Si vous avez configuré `strategy` sur `tasksFile`, vous devez créer un fichier `tasks.md` à la racine du projet avec la structure suivante :

```markdown
# Nom de la Milestone

Description de la milestone

## Titre de l'Issue 1

Description de l'issue 1

## Titre de l'Issue 2

Description de l'issue 2

# Autre Milestone

Description de l'autre milestone

## Titre de l'Issue 3

Description de l'issue 3
```

Chaque titre de niveau 1 (`#`) représente une milestone, et chaque titre de niveau 2 (`##`) représente une issue associée à cette milestone.

## Fonctionnalités avancées

### Smart Commit Messages

Le script analyse les fichiers modifiés pour générer des messages de commit significatifs suivant le format de commits conventionnels:

```text
type(scope): description
```

Par exemple:

- `feat(auth): add user authentication`
- `fix(api): resolve data fetching issue`
- `docs(readme): update installation instructions`

Le script:

1. Détermine le type de changement (feat, fix, docs, style, etc.) en analysant les extensions et chemins des fichiers
2. Identifie le scope en analysant la structure des dossiers
3. Génère une description pertinente basée sur le type de changement et les fichiers modifiés
4. Ajoute une liste des fichiers modifiés pour les commits importants

### Auto Issue Creation

Lorsque des changements sont détectés, le script peut automatiquement créer des issues:

1. Regroupe les fichiers liés par composant
2. Crée des titres et descriptions d'issues détaillés
3. Attribue des étiquettes appropriées
4. Lie les issues au milestone du sprint actuel
5. Assigne les issues au propriétaire du dépôt

### Auto Status Updates

Le script peut automatiquement mettre à jour le statut des issues basé sur les messages de commit:

1. Extrait les numéros d'issues des messages de commit (ex: `fixes #123`)
2. Ajoute des commentaires aux issues référencées avec les détails du commit
3. Ferme les issues lorsque c'est approprié
4. Met à jour les étiquettes des issues en fonction des changements
5. Ferme automatiquement les milestones lorsque toutes les issues sont résolues

### Fermeture automatique des issues

Pour fermer automatiquement une issue, incluez l'un des mots-clés suivants dans votre message de commit, suivi du numéro de l'issue:

- `close #123`
- `closes #123`
- `closed #123`
- `fix #123`
- `fixes #123`
- `fixed #123`
- `resolve #123`
- `resolves #123`
- `resolved #123`

Le script supporte également les références multiples (ex: `fixes #123, #124, #125`) et les références croisées entre dépôts.

### Gestion des fichiers bloqués

Le script gère intelligemment les situations où GitHub bloque un push en raison de la détection de secrets ou d'autres problèmes de sécurité :

1. Lorsqu'un push est bloqué, le script crée automatiquement un rapport détaillé
2. Le script identifie le fichier problématique à l'origine du blocage
3. Une copie du fichier problématique est sauvegardée pour analyse ultérieure
4. Le fichier est retiré du commit tout en étant conservé dans le système de fichiers local
5. Le script tente à nouveau de pousser les changements sans le fichier problématique
6. Un rapport complet est généré avec toutes les informations nécessaires

Cette fonctionnalité permet d'éviter qu'un seul fichier problématique ne bloque l'ensemble du processus d'automatisation.

## Exemples

### Exemple de workflow automatisé

1. Vous modifiez des fichiers dans votre projet
2. Le script détecte les changements
3. Le script crée des issues et des milestones basées sur les changements (selon la stratégie configurée)
4. Le script crée un commit avec un message standardisé
5. Le script pousse les changements vers le dépôt distant
6. Le script ferme les issues mentionnées dans le message de commit

## Logging

Le script intègre un système de logging complet basé sur Winston qui enregistre toutes les actions d'automatisation effectuées. Vous pouvez configurer le comportement du logging dans la section `logging` du fichier `config.json` :

```json
"logging": {
  "enabled": true,
  "level": "info",
  "consoleLevel": "info",
  "filePath": "./logs/automation-%DATE%.log",
  "maxFiles": "14d",
  "maxSize": "20m",
  "patchConsole": true,
  "preserveConsole": false
}
```

### Paramètres de logging

- `enabled` : Activer/désactiver le logging
- `level` : Niveau de log global (debug, info, warn, error)
- `consoleLevel` : Niveau de log pour la console (peut être différent du niveau global)
- `filePath` : Chemin du fichier de log (avec rotation basée sur la date)
- `maxFiles` : Durée de conservation des fichiers de log (ex: "14d" pour 14 jours)
- `maxSize` : Taille maximale d'un fichier de log avant rotation
- `patchConsole` : Rediriger les appels console.log, console.error, etc. vers le logger
- `preserveConsole` : Conserver les sorties console originales en plus du logging

### Niveaux de log

- `error` : Erreurs critiques qui empêchent le fonctionnement normal
- `warn` : Avertissements qui n'empêchent pas le fonctionnement mais méritent attention
- `info` : Informations générales sur le fonctionnement du script (niveau par défaut)
- `debug` : Informations détaillées utiles pour le débogage

Les logs sont écrits à la fois dans la console et dans des fichiers avec rotation quotidienne, ce qui permet de conserver un historique des actions tout en limitant l'espace disque utilisé.

## Sécurité

- Ne stockez jamais votre token GitHub directement dans le fichier `config.json`
- Utilisez toujours un fichier `.env` ou une variable d'environnement pour stocker votre token
- Assurez-vous que le fichier `.env` est inclus dans votre `.gitignore`

## Licence

MIT

## Avertissement

Ce script est fourni tel quel, sans garantie d'aucune sorte. Utilisez-le à vos propres risques. Assurez-vous de comprendre ce que fait le script avant de l'utiliser dans un environnement de production.
