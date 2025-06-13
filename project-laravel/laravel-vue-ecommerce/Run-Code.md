# Laravel Vue Ecommerce Setup Guide

This guide explains how to set up and run the Laravel-Vue-Ecommerce project using three terminal instances.

## Prerequisites

-   PHP, Composer, Node.js, and npm installed on your system.
-   Project directory: `laravel-vue-ecommerce`.

## Terminal 1: Laravel Backend Server

1. Navigate to the project directory:

    ```bash
    cd laravel-vue-ecommerce
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

    Or update dependencies if needed:

    ```bash
    composer update
    ```

3. Install Node.js dependencies for the Vue theme:

    ```bash
    npm install
    ```

4. Start the Laravel development server (runs on `http://localhost:8000` for the user-facing web):

    ```bash
    php artisan serve
    ```

**Access the user-facing website** at `http://localhost:8000`.
**Credentials** :

-   Email: `admin@example.com`
-   Password: `admin123`

## Terminal 2: Vue Frontend Development

1. Navigate to the project directory:

    ```bash
    cd laravel-vue-ecommerce
    ```

2. Run the Vue development server:

    ```bash
    npm run dev
    ```

    **Note** : This terminal compiles the Vue frontend but does not serve the user-facing website. The website is served via `http://localhost:8000` from Terminal 1.

## Terminal 3: Admin Backend Development

1. Navigate to the project directory and then to the `backend` folder:
    ```bash
    cd laravel-vue-ecommerce/backend
    ```
2. Install Node.js dependencies:
    ```bash
    npm install
    ```
3. Run the admin development server:
    ```bash
    npm run dev
    ```

**Access the admin dashboard** using the same credentials as the user-facing website:

-   Email: `admin@example.com`
-   Password: `admin123`

## Notes

-   The user-facing website is accessible only via `http://localhost:8000` (from `php artisan serve` in Terminal 1).
-   Ensure all terminals remain running to keep the Laravel server, Vue frontend, and admin dashboard functional.
-   If you encounter issues, verify that all dependencies are installed correctly and ports are not in use.
