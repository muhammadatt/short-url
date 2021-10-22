
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
5. Run ```"npm run dev"``` or ```"npm run prod"``` to generate dev/production build of frontend assets
6. Run ```"php artisan serve --port=8080"``` to serve the app

## Usage

## API Endpoints

GET /api/{shortcode}
Looks up a provided shortcode and returns a url object that contains the orignal url

```json
{
    "id": 659,
    "shortcode": "aD",
    "original": "https://www.appflowz.com",
    "nsfw": 0,
    "view_count": 2,
    "created_at": "2021-10-22T14:37:10.000000Z",
    "updated_at": "2021-10-22T15:11:03.000000Z"
}
```

POST /api/shorten
Accepts an object that contains the original long url and returns a url object that contains the shortcode

Accepts:

```json
{
 "original" : "https://www.google.com"
}
```
Returns:

```json
{
    "id": 659,
    "shortcode": "aD",
    "original": "https://www.appflowz.com",
    "nsfw": 0,
    "view_count": 2,
    "created_at": "2021-10-22T14:37:10.000000Z",
    "updated_at": "2021-10-22T15:11:03.000000Z"
}
```

GET /api/top
Returns a list that contains the 100 most frequently viewed urls
```json
[
    {
        "id": 433,
        "shortcode": "6Z",
        "original": "https://www.nitzsche.org/eaque-impedit-iste-optio-est-voluptas-est",
        "nsfw": 0,
        "view_count": 995408879,
        "created_at": "2021-10-22 05:44:27",
        "updated_at": "2021-10-22 05:44:27"
    },
    {
        "id": 521,
        "shortcode": "8p",
        "original": "http://www.wolff.com/maxime-quia-dolores-officia-dolores.html",
        "nsfw": 0,
        "view_count": 984942642,
        "created_at": "2021-10-22 13:58:12",
        "updated_at": "2021-10-22 13:58:12"
    }
]
```
## Web Endpoints

Homepage/Shorten Urls:
https://chiquito-url.herokuapp.com/

Show Top 100 Most Visited Urls:
https://chiquito-url.herokuapp.com/top

Resolve a shortened Url:
Safe: https://chiquito-url.herokuapp.com/3f
NSFW: https://chiquito-url.herokuapp.com/3g
Not Found Error: http://chiquito-url.herokuapp.com/4jaKz

## Notes

Shortener Algorithm

Turns out there are a lot of different ways to potentially code a url shortener. The basic gist of the approach that I used was to take auto-incremented primary key for each new entry and convert it to a string value (by converting it to Base62). I added a lengthy comment to the GeneratesShortcode Trait that discusses the considerations that I took into account when choosing my approach. 

Potential Upgrades/Changes




