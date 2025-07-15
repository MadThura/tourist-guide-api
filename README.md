# 🌍 Tourist Guide API

A Laravel-powered RESTful API that allows users to discover and explore popular tourist spots in Yangon, Myanmar. Built with scalability and simplicity in mind, it supports user authentication, place discovery, real-time location filtering, and more.

## 🚀 Features

- User Authentication (Login/Register)
- Browse tourist spots by category (Pagoda, History, Culture, Hotel, Museum,....)
- Search and filter tourist places
- View detailed information of each place
- Admin panel for managing places, users, categories, reviews
- RESTful API with Sanctum Authentication

## 🛠️ Built With

- [Laravel](https://laravel.com/) 11
- [MySQL](https://www.mysql.com/)
- [Tailwind CSS](https://tailwindcss.com/) (for admin panel)

##  📦 Installation

# Clone the repository
git clone https://github.com/MadThura/tourist-guide-api.git

# Navigate to the project
cd tourist-guide-api

# Install dependencies
composer install
npm install

# Copy .env file and configure database
cp .env.example .env
php artisan key:generate

# Set up your DB config in .env, then run:
php artisan migrate --seed

# Run the server
- php artisan serve
- npm run dev
