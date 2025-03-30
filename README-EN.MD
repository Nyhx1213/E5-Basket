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

## How to Use

### 1. Modify the Database Connection
To make the system functional, you need to modify the `connect.php` file. This file contains the database connection settings, which must be updated with your own database credentials.
- In the `connect.php` file, you'll find placeholders for:
  - `DNS` (Database source name)
  - `LOGIN` (Your database username)
  - `PASSWORD` (Your database password)
- Replace these placeholders with your actual database information.

### 2. Database Configuration
- A copy of the required database schema will be provided, so you can import it into your MySQL database. This database contains all the necessary tables and relationships to support the application’s functionality (e.g., users, roles, games, workouts).

### 3. Setup Process
- Ensure you have PHP and MySQL (or MariaDB) installed on your system.
- Import the provided database schema into your MySQL/MariaDB instance.
- Configure the `connect.php` file with your database credentials.
- Once everything is set up, the application will be ready for use. You can create accounts, log in, and use all the associated functionalities.

---
# User Management Function

The **User Management** functionality allows for easy user creation, login, and account recovery. It provides a secure system to manage user accounts and ensure appropriate access levels based on user roles. Here's a detailed breakdown of how these functions work.

## Account Creation

- A user can create a new account by filling out a registration form with the following fields:
  - **Username**: A unique identifier for the user.
  - **Email**: A valid email address. This is necessary for account recovery and communication.
  - **Password**: A password that is securely hashed before being stored in the database. The password must meet certain security criteria, such as length and complexity (which may be specified later).

- Once a user submits their account details, the system will:
  - **Verify the password**: A secure hashing algorithm (e.g., bcrypt) is used to ensure the password is not stored in plaintext in the database.
  - **Check for unique username and email**: The system will verify that the username and email are not already taken by another user.
  - **Assign the "User" role**: Upon successful account creation, the user is automatically assigned the "User" role. This means they have limited access (e.g., they can view upcoming games and player stats, but can't manage workouts or games).

- The new account details are saved in the database, and the user can then proceed to log in with their username and password.

## Login and Sessions

- After creating an account, a user can log in by providing their **username** and **password** through a login page.
  - **Session Handling**: Upon successful login, a session is created for the user, storing their username and role to identify them on subsequent pages.
  - Based on the user's role (e.g., Admin, Manager, Coach, Assistant, Player, or User), the system customizes their experience. Each role has access to specific features, and the user will see a personalized profile page with their relevant information.

- **Session Expiry**: If a user remains inactive for a certain period, their session may expire, requiring them to log in again for security purposes.

## Account Recovery (Forgot Password)

- If a user forgets their password, they can recover their account by entering their **email address** on a specific recovery page.
  - **Token Generation**: A unique token is generated and sent to the user's email address. This token is valid for 1 hour, during which the user can reset their password.
  - **Password Reset Form**: Once the user receives the email with the token, they can use it to access a password reset form, where they can input a new password.
  - **Expiry Check**: The token will expire after 1 hour, and any attempt to use an expired token will result in an error message.
  - **Security**: The system ensures that the token can only be used once, and passwords are securely updated in the database after the reset.

---
### Workout Management Function

The **Workout Management Function** allows authorized users to create, manage, and attend basketball workouts. The functionality is divided into three main parts:

#### 1. Workout Creation
- **Description**: 
    From the menu, a user with the appropriate permissions can access the **"Create a Workout"** page. This page provides a form to input the workout name, date, and duration. The form ensures that the date entered is not more than 1 year before or after the current date.
  
- **Allowed Roles**: 
    - Admin
    - Manager
    - Coach
  
- **Form Fields**: 
    - **Workout Name**: A name for the workout session.
    - **Date**: The date of the workout. Must be within 1 year before or after the current date.
    - **Duration**: The length of the workout session.

#### 2. Manage Workout Attendance
- **Description**: 
    Authorized users can access the **"Manage Workout Attendance"** page. Here, they can add players to existing workouts. The page will only show workouts that the player is not already assigned to.
  
- **Allowed Roles**: 
    - Admin
    - Manager
    - Coach
    - Assistant
  
- **Form Behavior**: 
    - The form will display a list of available workouts that the player is not already part of.
    - The user can select a player to add to a workout session.

#### 3. Workout Chart
- **Description**: 
    From the menu, users can enter the **"Workout List"** page. This page displays all the existing workouts. Users can click on a specific workout to view the details, including who is participating, the date, and the duration. Users with the correct permissions can also delete workouts.

- **Permissions**:
    - **Allowed Roles**: 
        - Admin
        - Manager
        - Coach
        - Assistant
        - Player
  
    - **Permissions to Delete a Workout**:
        - Admin
        - Manager
        - Coach

- **Functionality**:
    - View the list of workouts.
    - See the participating players for each workout.
    - View workout details (date, duration).
    - Delete workouts if the user has the required permissions.

---

## How to Use

### 1. **Create a Workout**:
To create a workout, navigate to the "Create a Workout" page from the main menu. Ensure that you input a valid date and duration for the workout. You can only create a workout within the date range allowed (within 1 year before or after the current date).

### 2. **Manage Workout Attendance**:
To manage workout attendance, go to the "Manage Workout Attendance" page. This will show a list of available workouts that players are not yet added to. Select a player from the list and add them to the workout session.

### 3. **Workout Chart**:
To see a list of existing workouts, go to the "Workout List" page. From there, you can view workout details, see participating players, and delete the workout if you have the right permissions.

---

## Technical Details

### Database Protection
We have added protections to prevent unauthorized access or manipulation of workout data through form submissions or direct URL manipulations. Proper validation and sanitization have been applied to forms and inputs to protect against common security vulnerabilities such as SQL injection and XSS (Cross-Site Scripting).

---
# Game Management Function

The **Game Management** functionality allows the management of basketball games, teams, and players. It provides tools for creating games, updating scores, and tracking player performance. Depending on the role of the user, they may have different permissions to view, create, modify, or delete games.

## Teams and Players Chart

### Description:
From the menu, click on the page **"Teams and Players Chart"**. This page displays a list of all teams, showing the number of wins each team has. The win count is automatically updated based on the results of the games created later on. For example, when a team wins a game, their win count will increase by one. You can also access each team's player list, and by clicking on a player, you will be able to view their individual stats.

In the player's stats page, you can see the games they have participated in, along with their average stats.

### Permissions:
- **View**: Everyone

---

## Game Creation/Planning

### Description:
From the menu, click on **"Manage Games"** to enter the game creation and planning page. Here, users with appropriate permissions can create a new game. They can specify the teams involved, the date of the game, the score (if available), and the location of the game. The score can be left blank initially and updated later. The form is protected against any form tampering to ensure valid data submission.

### Permissions:
- **Admin**: Can create, modify, and delete games.
- **Manager**: Can create and modify games.

---

## Game Chart

### Description:
From the menu, click on **"Game Chart"** to view a list of all games that have been played (games that have scores filled in). Here, you can modify existing games, remove them, and view player performance for each game.

### Permissions:
- **View**: Everyone
- **Modify/Delete**: Admin, Manager

---

## Add Scores to Planned Games

### Description:
From the menu, click on **"Modify Planned Games"** to view a list of games that have been created but do not yet have scores assigned. You can enter scores for these games, modify the date or location, and finalize the game details. This functionality helps to complete the match information once the game has been played.

### Permissions:
- **Admin**: Can add scores and modify game details.
- **Manager**: Can add scores and modify game details.

