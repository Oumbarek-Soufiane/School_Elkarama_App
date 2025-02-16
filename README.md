


# Alkarama Boussaid
Welcome to the Alkarama Boussaid School Management Web Application! This repository is dedicated to developing the Alkarama Boussaid application, a platform designed to manage the operations of a private school, utilizing React on the frontend and Laravel on the backend.

## Project Overview

- **Frontend (React):**
  - Explore the `frontend` directory for React components and views.
  - Install dependencies with `npm install`.

- **Backend (Laravel):**
  - Navigate to the `backend` directory for Laravel-specific functionalities.
  - Install dependencies using `composer install`.
  - Copy the `.env.example` file to `.env` and configure your environment.
  - Generate the application key with `php artisan key:generate`.
  - Run database migrations with `php artisan migrate`.

### Frontend Setup

```bash
cd frontend
npm install
npm start
```

### Backend Setup

```bash
composer install
```

```bash
cp .env.example .env
```

### Configure your database
### Note: Update DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD with your actual database configuration.

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1 
DB_PORT=3306
DB_DATABASE=yourdatabase
DB_USERNAME=username
DB_PASSWORD=password
```

### Generate key
```bash
php artisan key:generate
```

### Run database migrations
```bash
php artisan migrate
```
### Seed the database 
```bash
php artisan db:seed
```
### Install Passport for Laravel API Authentication and Generate Keys
```bash
php artisan passport:install
```
>>>>>>> 2c87b1c (global commit)
"# Aim_App" 
"# School_Elkarama_App" 
"# School_Elkarama_App" 
"# School_Elkarama_App" 
