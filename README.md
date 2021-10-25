
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

https://chiquito-url.herokuapp.com/api/3f

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

https://chiquito-url.herokuapp.com/api/shorten

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

https://chiquito-url.herokuapp.com/api/top

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

#### Homepage/Shorten Urls:

https://chiquito-url.herokuapp.com/

#### Show Top 100 Most Visited Urls:

https://chiquito-url.herokuapp.com/top

#### Resolve a shortened Url:

* Safe: https://chiquito-url.herokuapp.com/3f

* NSFW: https://chiquito-url.herokuapp.com/3i

* Not Found Error: http://chiquito-url.herokuapp.com/4jaKz


## Notes

#### Shortener Algorithm

It turns out that there are a lot of different ways to potentially handling the actual shortener. I spent a good bit of time considering different approaches. 

I eliminated the idea of trying to hash the actual url itself and settled on the idea of hashing the value of the integer primary key for each new database entry.

What I ended up finally doing was to take the auto-incremented primary key and converting it to a string value by converting it to Base62. I added a lengthy comment to the GeneratesShortcode Trait that discusses the considerations that I took into account and PROs/CONs of this approach. 

#### Potential Upgrades/Changes

* I'm currently validating user-submitted urls on the backend and returning an error message. Ideally we should also validate submitted urls on the front end before submitting to the server.
* If I were to continue development on this, I would probably use Vue Router to handle generating urls and handling redirects.
* Lots of potential frontend UI/design changes; mobile view is currently rather clunky.
* I'm currently using a simple approach to extract page titles from URLs. There are some potentially more robust scraping solutions here, but would require a decent amount of testing across a bunch of real world sites. 