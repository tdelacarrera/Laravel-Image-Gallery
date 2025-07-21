# Image Gallery

A simple image gallery web application built with Laravel.

## 📋 Prerequisites

- PHP
- Composer
- Node.js & npm
- MySQL

## 📦 Installation

Follow these steps to set up the project locally

**1. Clone the repository**

    git clone https://github.com/tdelacarrera/Laravel-Image-Gallery.git
    cd Laravel-Image-Gallery

**2. Install dependencies**

    composer install
    npm install

**3. Set up environment variables**

    cp .env.example .env

**4.  Run migrations, seed data, generate key and create storage link**

    php artisan migrate
    php artisan db:seed
    php artisan key:generate
    php artisan storage:link
    
**5. Build frontend assets**

    npm run dev

**6. Start the server**

    php artisan serve

 
You can use following login credentials.

    Email: admin@example.com

    Password: admin

✅ Ready!

Visit http://localhost:8000 to view the application in your browser.