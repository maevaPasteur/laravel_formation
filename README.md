# Laravel : Admin-UML

## Introduction

This project is an educational project. We must create an admin system for a society. Admin, teachers and student should be able to use this website to view the formations, sessions, etc.

## Installation

```
composer install
npm install
```

Create a clone of `.env.example` and generate an app encryption key.

```
cp .env.example .env
php artisan key:generate
```

Then, create an empty db for our app, and change the `.env`, to connect the db.

Migrate the DB.

```
php artisan migrate
```

All is done ! You can have fun !

## Documentation

### Securised routes

Different kind of route protection have be set.  
We've set route for user or admin. These users must be verified to use the route.

#### Verified users

```php
Route::middleware('can:verified')->group(function () {
  Route::method('url', 'Controller@method');
});
```

#### Teachers

```php
Route::middleware('can:is-teacher')->group(function () {
  Route::method('url', 'Controller@method');
});
```

#### Admins

```php
Route::middleware('can:is-admin')->group(function () {
  Route::method('url', 'Controller@method');
});
```
