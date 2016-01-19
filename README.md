# Bookmarks - A Laravel-based bookmark manager

This is a simple bookmark manager written in Laravel and using Boostrap. Its more a proof-of-concept and not really ready for production... yet.

## Requirements

* Suitable server (LAMP-based)
* A MySQL database for use with Bookmarks (utf8 should be fine)
* Bower (and thus Node/NPM)

## Up and Running
Create your MySQL database and clone this repo into a new vhost/web dir.

Run composer's install option to grab everything for Laravel:
```
composer install
```
Run bower's install option to grab all of the required .js/.css (public/assets/vendor):
```
bower install
```
Copy over .env.example so you have your own preferences file:
```
cp .env.example .env
```
Edit it and modify the last 4 lines:
```
nano .env
```
```
DB_HOST=localhost
DB_DATABASE=bookmarks
DB_USERNAME=user
DB_PASSWORD=password
```
Run Laravel/artisan to generate a new app key:
```
php artisan key:generate
```
Run the migrations and database seeders to get you up and running:
```
php artisan migrate
```
```
php artisan db:seed
```
Set permissions appropriately
```
chmod -R 777 /my/bookmarks/webroot
```
Default user/password is: admin@localhost/password

## The Dashboard

![The Dashboard](https://raw.githubusercontent.com/jjcosgrove/laravel-bookmarks/master/grabs/dashboard.png)

## Features
* Basic accounts
* Public/private bookmarks
* Filter by visibility & tags
* Search

## Todo
* Tidy up/refactoring
* API
* Favourites
* Profiles
    * Scope settings
    * Themes
    * View settings
* Lots more

## Notes
There is already a .htaccess in the root to rewrite to /public
