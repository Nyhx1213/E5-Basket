# Basketball Management Application

## Introduction
This application is designed to help manage basketball-related activities, including user management, game management, workout management, and statistics tracking. It provides different levels of access based on user roles to ensure proper functionality and security.

### Features:
#### 1. User Management
- Users can create accounts, log in, and reset their passwords if forgotten.
- A personalized profile page displays relevant information.
- Permissions are managed through different roles:
  - **Admin**: Has full access to all features.
  - **Manager**: Can create, delete, modify, and plan games, add and remove workouts, and manage players in workouts.
  - **Coach**: Can create and delete workouts, see player and game information, and add players to workouts.
  - **Assistant**: Can do everything a coach can except create workouts.
  - **Player**: Can view match information, personal stats, and workout details.
  - **Normal User**: Can only see upcoming games and player statistics.

#### 2. Workout Management
- Users with appropriate permissions can create workouts with details such as:
  - Name
  - Date
  - Duration
  - Players participating
- Users can view a list of created workouts, delete them, and see which players are involved.
- Security measures are implemented to protect the database from unauthorized form submissions and URL manipulations.

## Functionality Details
(To be added as we expand the documentation.)

