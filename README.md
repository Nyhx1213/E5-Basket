# Gestion d'équipes de basket

## Introduction
Cette application est conçue pour gérer divers aspects d’une organisation de basketball, y compris la gestion des utilisateurs, des entraînements et des matchs. Le système inclut des permissions basées sur les rôles afin d'assurer un contrôle d'accès approprié.

## Fonctionnalités

### Gestion des Utilisateurs
- Les utilisateurs peuvent créer des comptes et se connecter.
- Une fonctionnalité de récupération de mot de passe est disponible.
- Les profils utilisateurs affichent des informations personnalisées.
- Les permissions basées sur les rôles incluent :
  1. **Admin** - Accès à toutes les fonctionnalités.
  2. **Manager** - Peut créer, supprimer et modifier des matchs, planifier des matchs, ajouter et supprimer des entraînements, et assigner des joueurs aux entraînements.
  3. **Coach** - Peut créer et supprimer des entraînements, voir les informations des joueurs, les détails des matchs et assigner des joueurs aux entraînements.
  4. **Assistant** - Similaire au Coach mais ne peut pas créer d’entraînements.
  5. **Joueur** - Peut voir les détails des matchs, ses statistiques personnelles et les entraînements auxquels il participe.
  6. **Utilisateur Normal** - Peut voir les prochains matchs et les statistiques des joueurs.

### Gestion des Entraînements
- Les utilisateurs peuvent créer des entraînements en spécifiant un nom, une date, une durée et les joueurs participants.
- Les entraînements peuvent être listés, supprimés et revus pour vérifier la participation des joueurs.
- Des mesures de sécurité sont en place pour empêcher tout accès non autorisé à la base de données via des formulaires ou des paramètres d’URL.

### Gestion des Matchs
- Créer des rencontres de basketball avec des scores (ou mettre à jour les scores plus tard).
- Modifier les matchs existants si nécessaire.
- Supprimer des matchs au besoin.
- Voir la performance d’un joueur lors d’un match.
- Calculer les statistiques des joueurs en fonction de leurs performances en match.

---

## Comment Utiliser

### 1. Modifier la Connexion à la Base de Données
Pour que le système fonctionne, vous devez modifier le fichier `connect.php`. Ce fichier contient les paramètres de connexion à la base de données, qui doivent être mis à jour avec vos propres identifiants.
- Dans le fichier `connect.php`, vous trouverez des espaces réservés pour :
  - `DNS` (Nom de la source de données)
  - `LOGIN` (Votre nom d'utilisateur pour la base de données)
  - `PASSWORD` (Votre mot de passe pour la base de données)
- Remplacez ces espaces réservés par vos informations réelles de base de données.

### 2. Configuration de la Base de Données
- Une copie du schéma de base de données requis sera fournie afin que vous puissiez l’importer dans votre base MySQL. Cette base contient toutes les tables et relations nécessaires au bon fonctionnement de l’application (ex. : utilisateurs, rôles, matchs, entraînements).

### 3. Processus d’Installation
- Assurez-vous d’avoir PHP et MySQL (ou MariaDB) installés sur votre système.
- Importez le schéma de base de données fourni dans votre instance MySQL/MariaDB.
- Configurez le fichier `connect.php` avec vos identifiants de base de données.
- Une fois l’installation terminée, l’application sera prête à l’emploi. Vous pourrez créer des comptes, vous connecter et utiliser toutes les fonctionnalités associées.

---

# Fonctionnalité de Gestion des Utilisateurs

La **gestion des utilisateurs** permet une création de comptes simple, une connexion sécurisée et une récupération de compte en cas d’oubli de mot de passe. Cette section détaille les principales fonctionnalités.

## Création de Compte

- Un utilisateur peut créer un nouveau compte en remplissant un formulaire d’inscription comprenant :
  - **Nom d'utilisateur** : Identifiant unique.
  - **Email** : Adresse email valide pour la récupération de compte et la communication.
  - **Mot de passe** : Stocké de manière sécurisée (hachage avec bcrypt).
  - **Vérification** : Assure que l'email et le nom d'utilisateur ne sont pas déjà pris.
  - **Attribution de rôle** : L’utilisateur est par défaut assigné au rôle "Utilisateur Normal".

## Connexion et Sessions

- Une fois inscrit, l’utilisateur peut se connecter en entrant son **nom d’utilisateur** et **mot de passe**.
  - **Gestion des sessions** : Une session est créée pour identifier l’utilisateur et appliquer les restrictions d’accès selon son rôle.
  - **Expiration de session** : Après une période d’inactivité, l’utilisateur devra se reconnecter.

## Récupération de Compte (Mot de Passe Oublié)

- En cas d’oubli, l’utilisateur peut entrer son **email** sur la page de récupération.
  - **Génération de jeton sécurisé** : Un lien unique est envoyé par email et est valide pendant 1 heure.
  - **Formulaire de réinitialisation** : Permet à l’utilisateur de saisir un nouveau mot de passe.
  - **Vérification d’expiration** : Le jeton expire après 1 heure.
  - **Sécurité** : Un jeton ne peut être utilisé qu’une seule fois.

---

### Fonctionnalité de Gestion des Entraînements

La **gestion des entraînements** permet aux utilisateurs autorisés de créer, gérer et suivre la participation des joueurs.

#### 1. Création d’un Entraînement
- **Description** : Un formulaire permet d’entrer le nom, la date et la durée de l’entraînement.
- **Rôles autorisés** :
  - Admin
  - Manager
  - Coach
- **Contraintes** :
  - La date doit être dans l’intervalle d’un an avant ou après la date actuelle.

#### 2. Gestion de la Participation
- **Description** : Permet d’ajouter des joueurs à un entraînement.
- **Rôles autorisés** :
  - Admin
  - Manager
  - Coach
  - Assistant

#### 3. Liste des Entraînements
- **Affichage** : Liste des entraînements existants avec leurs détails (joueurs participants, durée, date).
- **Permissions** :
  - Tous les utilisateurs peuvent consulter.
  - Suppression réservée aux Admins, Managers et Coachs.

---

# Fonctionnalité de Gestion des Matchs

La **gestion des matchs** permet de créer des rencontres, enregistrer des scores et suivre les performances des joueurs.

## Tableau des Équipes et Joueurs
- **Affichage** : Liste des équipes avec leur nombre de victoires mis à jour automatiquement.
- **Consultation** : Statistiques des joueurs et historique des matchs.
- **Permissions** : Accessible à tous.

## Création/Planification des Matchs
- **Ajout d’un match** : Sélection des équipes, date, lieu et score (peut être ajouté plus tard).
- **Rôles autorisés** :
  - Admin (création, modification, suppression)
  - Manager (création, modification)

## Suivi des Matchs
- **Affichage des matchs joués** avec leurs résultats.
- **Modification/Suppression** : Réservé aux Admins et Managers.

## Ajout des Scores aux Matchs Planifiés
- **Mise à jour des résultats après un match joué**.
- **Rôles autorisés** :
  - Admin
  - Manager

---

## Détails Techniques

### Protection de la Base de Données
Des mesures de sécurité sont mises en place pour empêcher toute modification non autorisée des données via des soumissions de formulaires ou la manipulation directe des URL :
- Validation et filtrage des entrées.
- Protection contre les injections SQL et attaques XSS.

---
