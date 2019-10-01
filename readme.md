# Press Start CMS
Simple CMS based on Laravel 6.0 framework

## Table of contents
* [Installation](#Installation)
* [TODO list](#TODO-list)

## Installation
### 1. Clone repository
```
git clone https://github.com/reenekt/press-start-cms.git
```

### 2. Env
Copy `<project dir>/.env.example` to `<project dir>/.env` and customize for yourself

### 3. Composer
Install composer dependencies
```
composer install
```

### 4. NPM/Yarn
Install frontend dependencies with NPM or Yarn
```
npm install
```
or
```
yarn
```

### 5. Create Database
Create new MySQL database and update your `.env` settings

### 6. Artisan
Generate application key
```
php artisan key:generate
```

Apply migrations
```
php artisan migrate
```

Fill database with dummy data. It will add some posts.
```
php artisan db:seed
```

## TODO list
* [ ] Add admin dashboard
* [ ] Make current editor (with its styles) more beautiful
* [ ] Remake current editor component: separate to 2 components (view and edit)
* [x] Add plugins system
* [ ] Add themes system
* [x] Add marketplace app for plugins and themes (https://github.com/reenekt/press-start-platform)
* [ ] Add tests
* [ ] Add GitHub Page for this repository


<p align="center">Created with using <a href="https://laravel.com">Laravel Framework</a></p><br>
<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>
