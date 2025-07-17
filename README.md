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
```bash
git clone https://github.com/tdelacarrera/Laravel-Image-Gallery.git
cd Laravel-Image-Gallery
```
**2. Install dependencies**
```bash
composer install
npm install
``` 
**3. Set up environment variables**
```bash
cp .env.example .env
```
**4. Create the MySQL database**

Create a new database and update your .env

**5. Run migrations, seed data, and generate key**
```bash
php artisan migrate
php artisan db:seed
php artisan key:generate
```

**6. Build frontend assets**
```bash
npm run dev
```

**7. Start the server**
```bash
php artisan serve
```
✅ Ready!

Visit http://localhost:8000 to view the application in your browser.
