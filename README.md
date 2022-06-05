# Back End
[![Actions Status](https://github.com/racing-coffe/backend/actions/workflows/ci.yml/badge.svg)](https://github.com/racing-coffe/backend/actions)

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

## Endpoints
| Method | Route                       | Route Name       | Controller                          | Description                    |
| ------ | --------------------------- | ---------------- | ----------------------------------- | ------------------------------ |
|  GET   |  api/posts                  | post.index       | MainApi\PostController@index        | List all Posts                 |
|  GET   |  api/posts/{id}             | post.show        | MainApi\PostController@show         | Show a Specific Post           |
|  GET   |  api/authors                | author.index     | MainApi\AuthorController@index      | List all Authors               |
|  GET   |  api/authors/{id}           | author.show      | MainApi\AuthorController@show       | Show a Specific Author         |
|  GET   |  api/authors/{id}/posts     | author.showPosts | MainApi\AuthorController@showPosts  | List all Posts from An Author  |
|  GET   |  api/tags                   | tag.index        | MainApi\TagController@index         | List all Tags                  |
|  GET   |  api/tags/{id}              | tag.show         | MainApi\TagController@show          | Show a Specific Tag            |
|  GET   |  api/tags/{id}/posts        | tag.showPosts    | MainApi\TagController@showPosts     | List all Posts from A Tag      |

## Trello
You can view `Todo`, `Doing` and `Done` Tasks on Trello.
[Link](https://trello.com/b/WCbMv3Q8/back-end)
