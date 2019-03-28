## Table of Contents
- [Todo Api Laravel](#todo-api-laravel)
- [Getting Started using Docker](#getting-started-using-docker)
    * [Prerequisites](#prerequisites)
    * [Clone With Git](#clone-with-git)
    * [Create Your env File](#create-your-env-file)
    * [Start Docker Containers](#start-docker-containers)
    * [Install Composer Dependencies](#install-composer-dependencies)
    * [Setup Laravel](#setup-laravel)
- [Schema](#schema)
- [Endpoints](#endpoints)
- [Running Tests](#running-tests)

## Todo Api Laravel
This is a todo app api using [Laravel](https://laravel.com/).

This projects serves as an example to:
- Build a REST API in PHP Laravel framework, with the following:
    - MySQL as database
- Test driven development mindset:
    - Working with PHPUnit
- Build in a Dockerized environment

## Getting Started using Docker

Quickstart guide to getting Docker-based dev environment up and running.

### Prerequisites

You need Docker installed. Use native version for your OS - use Toolbox only as last resort.
- Docker for Windows (preferred)
- Docker for Mac (preferred)
- Docker Toolbox

To run .sh scripts in a Windows environment, use Git Bash.

### Clone With Git

Do this step if you're starting fresh.

```
https://github.com/khoo0030/api-todo-laravel.git
```

### Create Your env File

By default, Laravel comes with a .env.example which is committed to version control.

Make a copy and name it .env.

```
cp .env.example .env
```

### Start Docker Containers
There are 5 services in the docker compose file

| Services | App | Exposed Port | Remarks |
| --- | --- | --- | --- |
| web | Nginx | 8080| Access on http://localhost:8080 |
| app | Laravel | | |
| app_test | Laravel - for running tests on JetBrains IDE | | |
| pma | PhpMyAdmin | 8081 | Access on http://localhost:8081 |
| db | MySql | | |

Run docker compose

cd into the project root folder and run:

```
docker-compose up -d
```

### Install Composer Dependencies
Composer will be installed when you run the docker container app service.
Bash into the app service and install composer dependencies.

In the project root folder, run:

```
docker-compose exec app /bin/bash
```

When you are in the app container, run:

```
composer install
```

### Setup Laravel

Still in the app container, run following to generate app key and run migrations

```
php artisan key:generate
```

```
php artisan migrate:fresh
```

## Schema

todo table

| Column | Type | 
| --- | --- | 
| id | Primary key | 
| title | varchar | 
| created_at | timestamp | 
| updated_at | timestamp | 

## Endpoints

| Http verb | Path | Description | 
| --- | --- | --- | 
| POST | /api/v1/todos | Create a todo record | 
| GET | /api/v1/todos | Get all todo records | 
| GET | /api/v1/todos/{id} | Get a todo record | 
| PUT | /api/v1/todos/{id} | Update a todo record | 
| DELETE | /api/v1/todos/{id} | Delete a todo record | 

## Running Tests

This project tests setup. Database and migrations must be setup before running tests. 

Bash into the docker container and run:

```
./vendor/bin/phpunit
```
