# Gamify App Setup Guide

This guide will walk you through the process of setting up the Gamify application on your local machine.

## Prerequisites

- PHP >= 8.0
- Composer
- MySQL

## Installation

1. **Clone the repository:**

   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. **Install dependencies:**

   ```bash
   composer install
   ```

3. **Database setup:**

   - Create a new MySQL database named `yii2_gamify`.
   - Import the database schema and data from the `db/gamify.sql` file:

     ```bash
     mysql -u <username> -p yii2_gamify < db/gamify.sql
     ```

4. **Configure the application:**

   - Copy the `config/db.php.example` file to `config/db.php`.
   - Update the `config/db.php` file with your database credentials.

5. **Run the application:**

   - Start the built-in PHP web server:

     ```bash
     php yii serve
     ```

   - Open your web browser and navigate to `http://localhost:8080`.

## Usage

You can now register a new account or log in with one of the dummy accounts:

- **Username:** `testuser`
- **Password:** `password`

- **Username:** `testuser2`
- **Password:** `password`
