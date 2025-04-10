# Laravel Project Setup Guide

This is a guide to help you set up and run a Laravel project after cloning it from GitHub.

## 1. Clone the Project from GitHub
First, clone the project to your local machine using the following Git command:

```bash
git clone https://github.com/linhmt13113/recommender_course_registration.git
cd 
```

## 2. Install Dependencies

```bash
composer install
```

## 3. Configure Environment

```bash
cp .env.example .env
```
Then, open the .env file and configure it with your database connection settings
DB_DATABASE : Your database name

DB_USERNAME : Your database username

DB_PASSWORD : Your database password

Import database: course_registration.sql to your database

## 4. Run the Project

```bash
php artisan serve
```

