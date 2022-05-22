# Back End
The Backend of Racing Coffe

This is a Formula 1 Blog REST API Project. Made with PHP Laravel Framework.

> Project in Development

## Features
- View Authors
- View Tags
- View Posts 

## How to Use
1. Clone the Repository
```
git clone https://github.com/Racing-Coffe/backend.git
cd backend
composer install
```

2. Configure the Database:

   In your .ENV file
```
DB_CONNECTION=pgsql
DB_HOST=1.0.1.0
DB_PORT=0001
DB_DATABASE=db_name
DB_USERNAME=db_username
DB_PASSWORD=db_password
```

3. Run artisan commands:
```
php artisan migrate:fresh --seed
php artisan key:generate
php artisan serve
```
