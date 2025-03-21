# Quote Management API (Backend)

This is the backend for the Quote Management application, built with Laravel. It provides an API for user authentication, fetching random quotes from the ZenQuotes (Quotables didn't respond during this work) API, and managing saved quotes.

## Prerequisites
- **PHP** (8.4.5)
- **Composer** (2.7.1)
- **MySQL** (8.3.0)
- **Git**

## Setup Locally
1. **Clone the Repository**
   ```bash
   git clone https://github.com/Chea-ming/quote_api_backend.git
   cd quote_api_backend

2. **Install Dependencies**
    ```bash
    composer install

3. **Set up Environment file**
    ```bash
    cp .env.example .env

4. **Edit env file with database detail**
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=quote_management
    DB_USERNAME=root
    DB_PASSWORD=

5. **Generate Application Key**
    ```bash
    php artisan key:generate

6. **Install Laravel Sanctum**
    ```bash
    composer require laravel/sanctum
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

7. **In MySQL, create a database**
    CREATE DATABASE quote_management;
    
8. **Run Migrations**
    ```bash
    php artisan migrate

9. **Run Backend**
    ```bash
    php artisan serve

## Testing API Endpoints

Using Postman

1. **Register a user**

    POST http://127.0.0.1:8000/api/register
    Content-Type: application/json
    Body: {
    "name": "user",
    "email": "user@example.com",
    "password": "password123",
    "password_confirmation": "password123"
    }

2. **Login**

    POST http://127.0.0.1:8000/api/login
    Content-Type: application/json
    Body: {
    "email": "user@example.com",
    "password": "password123"
    }

3. **Fetch a random quote**
    GET http://127.0.0.1:8000/api/quotes/random

4. **Save a quote**
    POST http://127.0.0.1:8000/api/quotes
    Authorization: Bearer <token>
    Content-Type: application/json
    Body: {
    "content": "Life is what happens when you're busy making other plans.",
    "author": "John Lennon"
    }

5. **Get saved quotes**
    GET http://127.0.0.1:8000/api/quotes
    Authorization: Bearer <token>

6. **Delete a saved quote**
    DELETE http://127.0.0.1:8000/api/quotes/1
    Authorization: Bearer <token>


    
