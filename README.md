# Junior-Software-Engineer-Backend-PHP

## Description

This repository contains a Laravel API project in the `backend` folder and a Vue.js frontend in the `frontend` folder. The backend serves as an API endpoint, while the frontend consumes this API to provide a user interface.

## Prerequisites

Before you begin, ensure you have the following installed:

- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [npm](https://www.npmjs.com/)
- [MySQL](https://www.mysql.com/)

## Setup

### Backend

1. **Environment Setup:**
   - Copy the `.env.example` file to `.env` in the `backend` folder.
   - Update the `.env` file with your database connection details.
   - 
2. **Install Dependencies:**
   - Run the following command to install PHP dependencies:
     ```bash
     cd backend
     composer install
     ```
     
3. **Database Migration:**
   - Run the following commands to migrate the database:
     ```bash
     
     php artisan migrate
     ```

4. **Storage Link:**
   - Run the following command to create a symbolic link to the storage directory:
     ```bash
     php artisan storage:link
     ```



### Frontend

1. **Environment Setup:**
   - Copy the `.env.example` file to `.env` in the `frontend` folder.

2. **Install Dependencies:**
   - Run the following command to install Node.js dependencies:
     ```bash
     cd frontend
     npm install
     ```



### Backend

- Run the following command to start the Laravel development server:
  ```bash
  php artisan serve

### Frontend

- Run the following command to start the Vue.js development server:
  ```bash
  cd frontend
  npm run serve
