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
| Method  | Route                       | Route Name          | Controller                           | Description                    | Authorization                |
| ------- | --------------------------- | ------------------- | ------------------------------------ | ------------------------------ | ---------------------------- |
|  GET    |  api/posts                  | post.index          | MainApi\PostController@index         | List all Posts                 | None                         |
|  GET    |  api/posts/{id}             | post.show           | MainApi\PostController@show          | Show a Specific Post           | None                         |
|  GET    |  api/authors                | author.index        | MainApi\AuthorController@index       | List all Authors               | None                         |
|  GET    |  api/authors/{id}           | author.show         | MainApi\AuthorController@show        | Show a Specific Author         | None                         |
|  GET    |  api/authors/{id}/posts     | author.showPosts    | MainApi\AuthorController@showPosts   | List all Posts from An Author  | None                         |
|  GET    |  api/tags                   | tag.index           | MainApi\TagController@index          | List all Tags                  | None                         |
|  GET    |  api/tags/{id}              | tag.show            | MainApi\TagController@show           | Show a Specific Tag            | None                         |
|  GET    |  api/tags/{id}/posts        | tag.showPosts       | MainApi\TagController@showPosts      | List all Posts from A Tag      | None                         |
|  POST   |  api/auth/users             | auth.user.store     | AuthApi\AuthUserController@store     | Store a new User               | Return the Access Token      |
|  POST   |  api/auth/users/login       | auth.user.login     | AuthApi\AuthUserController@login     | Login an User                  | Return the Access Token      |
|  POST   |  api/auth/users/setauthor   | auth.user.setAuthor | AuthApi\AuthUserController@setAuthor | Set an User as Author          | Needs be Admin               |
|  PUT    |  api/auth/users             | auth.user.update    | AuthApi\AuthUserController@update    | Update Data from User          | Needs Access Token from User |
|  DELETE |  api/auth/users             | auth.user.destroy   | AuthApi\AuthUserController@destroy   | Delete an User                 | Needs Access Token from User |


## Trello
You can view `Todo`, `Doing`, `Deliver` and `Done` Tasks on Trello.
[Link](https://trello.com/b/WCbMv3Q8/back-end)

## How to Contribute
You can create an issue in this repository. 

If your idea is really good, I will return an ID, which will be used in the future.

### Now it's time to shine!
Create a Branch and start developing. 
> The Branch Name is: `RC-{The ID that I Returned Earlier}` 
> 
> The Commits specification is [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/). The optional Scope is: `RC-{The ID that I Returned Earlier}`

After that, you can open an Pull Request and i will make the Code Review.
