<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Laravel Topics

This repository contains the list of Laravel topics that i wanna to learn.

# SETUP

### 1. Clone The repo to your locale
- **using ssh key**
```
git clone https://github.com/AliAtefAli/laravel-topics.git
```

- **using https**
```
git clone https://github.com/AliAtefAli/laravel-topics.git
```
### 2. [Optional] Rename the repo

```
mv Dashboard_Awamer_2021 your_name
```

### 2. cd into

```
cd your_name_or_Dashboard_Awamer_2021
```

### 4. Install Composer Dependencies

Whenever you clone a new Laravel project you must now install all the project dependencies. This is what actually installs Laravel itself, among other necessary packages to get started.

```
composer install
```

### 5. Create a copy of your .env file
`.env` files are not generally committed to source control for security reasons. But there is a `.env.example` which is a template of the `.env` file that the project expects us to have.

```
cp .env.example .env
```

### 6. Generate an app encryption key
Laravel requires you to have an app encryption key which is generally randomly generated and stored in your `.env` file. The app will use this encryption key to encode various elements of your application from cookies to password hashes and more.

```
php artisan key:generate
```

### 7. Create an empty database for our application
Create an empty database for your project

### 8. In the .env file, add database information to allow Laravel to connect to the database
We will want to allow Laravel to connect to the database that you just created in the previous step. To do this, we must add the connection credentials in the .env file and Laravel will handle the connection from there.

### 9. Migrate the database

```
php artisan migrate
```

#### 10. Seed the database

```
php artisan db:seed
```

### 11. server your project
Start up a local development server with `php artisan serve` And, visit the URL http://localhost:8000/dashboard in your browser.

If you installed with our data, an admin has been created for you with the following login credentials:

```
Email: admin@admin.com
Password: 123456789
```
