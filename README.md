# Basketball Management Application

## Introduction
This application is designed to manage various aspects of a basketball organization, including user management, workout management, and game management. The system includes role-based permissions to ensure proper access control.

## Features

### User Management
- Users can create accounts and log in.
- Password recovery functionality is available.
- Personalized user profiles display relevant information.
- Role-based permissions include:
  1. **Admin** - Access to all functions.
  2. **Manager** - Can create, delete, and modify games, plan games, add and remove workouts, and assign players to workouts.
  3. **Coach** - Can create and delete workouts, view player information, game details, and assign players to workouts.
  4. **Assistant** - Similar to Coach but cannot create workouts.
  5. **Player** - Can view match details, personal stats, and workout details.
  6. **Normal User** - Can view upcoming games and player stats.

### Workout Management
- Users can create workouts, specifying name, date, length, and participating players.
- Workouts can be listed, deleted, and reviewed to check player participation.
- Security measures are in place to prevent unauthorized database access via forms or URL parameters.

### Game Management
- Create basketball matchups with scores (or update scores later).
- Modify existing games as needed.
- Delete games when necessary.
- View a player’s performance in a match.
- Calculate player statistics based on match performances.

---
More details on each function will be provided in the following sections.

