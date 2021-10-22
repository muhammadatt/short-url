
## About Short Url Generator

This application generates short urls (e.g. bit.ly/aEnD8jL) for a given url. 

## Installation

1. Create database and database user via your method of choice (e.g. PhpMyAdmin) 
2. Add your database credentials to your .env file, e.g.:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=short_url
DB_USERNAME=mydbuser
DB_PASSWORD=mydbpassword
```

3. Run ```"php artisan migrate"``` to run database migrations and create tables
4. Run ```"db artisan db:seed"``` to seed the database (required to demonstrate the top 100 visited urls). 
4. Run ```"php artisan serve --port=8080"``` to serve the api


