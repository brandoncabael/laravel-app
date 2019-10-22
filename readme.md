# Sample Laravel API For Todos

## Prerequisites

* Docker
* Docker-Compose

## Setup

* Clone the repo locally:
```
git clone https://github.com/brandoncabael/laravel-app.git ~/laravel-app
```

* Use docker's composer image to mount the directories for the Laravel Project:
```
docker run --rm -v $(pwd):/app composer install
```

* Just to ensure that the files are owned by your non-root user:
```
sudo chown -R $USER:$USER ~/laravel-app
```

* Run the docker-compose build command:
```
docker-compose build
```

* Start your containers:
```
docker-compose up -d
```

* Resolve weird error with log file permission denied:
```
docker-compose exec -u root app chmod -R 777 /var/www/storage
```

* Set the application key and cache the application settings:
```
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan config:cache
```

* Setup your database within container:
```
docker-compose exec db bash
mysql -u root -p
GRANT ALL ON laravel.* TO 'laraveluser'@'%' IDENTIFIED BY 'Password1234';
FLUSH PRIVILEGES;
EXIT;
exit
```

* Run the migration command to initialize the schema for your database:
```
docker-compose exec app php artisan migrate
```

* Run the passport install process:
```
docker-compose exec app php artisan passport:install
```
Make note of the Password Grant provider with it's client_id and client_secret

* Clear the config cache one more time after passport install:
```
docker-compose exec app php artisan config:cache
```

## Usage

### Register a new user

* Head over to `http://localhost` and click register in the top right corner to register a new user.

### Getting your API keys

* Perform a POST request to `http://localhost/oauth/token` with the following request body:
```
{
  "grant_type": "password",
  "username": YOUR-USERNAME-HERE,
  "password": YOUR-PASSWORD-HERE,
  "client_id": CLIENT-ID-FROM-PASSPORT-INSTALL,
  "client_secret": CLIENT-SECRET-FROM-PASSPORT-INSTALL
}
```

* You can now perform `GET`, `POST`, `PUT`, `SHOW` and `DELETE` on `http://localhost/api/todos`

**NOTE: You must use the "access_token" from the response body from the token POST request in the form of a header:**
```
Authorization: Bearer YOUR-TOKEN-HERE
```