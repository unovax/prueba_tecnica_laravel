# Installation Guide for Laravel App

This guide will walk you through the steps to install a Laravel app on your local machine.

## Prerequisites
Before you begin, make sure you have the following installed on your system:
- PHP (version 8.2 or higher)
- Composer
- Node.js
- NPM

## Step 1: Clone the Repository
Start by cloning the repository to your local machine using the following command:
```
git clone https://github.com/unovax/prueba_tecnica_laravel
```

## Step 2: Install Dependencies
Navigate to the project directory and install the required dependencies using Composer and NPM:
```
cd prueba_tecnica_laravel
composer install
npm install
```

## Step 3: Configure Environment Variables
Copy the `.env.example` file and rename it to `.env`. Update the necessary environment variables such as database credentials, app key, etc.

## Step 4: Generate App Key
Generate a new application key by running the following command:
```
php artisan key:generate
```

## Step 5: Run Migrations
Run the database migrations to create the required tables:
```
php artisan migrate
```

## Step 6: Start the Development Server
Start the Laravel development server using the following command:
```
php artisan serve
```
## Step 7: Start node server

Start the node development server using the following command:
```
npm run dev
```

## Step 8: Access the App
Open your web browser and navigate to `http://localhost:8000` to access the Laravel app.

That's it! You have successfully installed the Laravel app on your local machine.
