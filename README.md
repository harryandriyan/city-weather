# city-weather
[![Build Status](https://travis-ci.org/harryandriyan/city-weather.svg?branch=master)](https://travis-ci.org/harryandriyan/city-weather)  

nearby city’s weather

![picture](https://res.cloudinary.com/hamharry/image/upload/v1544779974/city-weather_1_mb1zhd.png)

## Configuration

### Clone Repo
```
git clone https://github.com/harryandriyan/city-weather.git
```

### Change directory and install dependencies
```
cd city-weather
composer install
composer require guzzlehttp/guzzle
```

### Database Configuration
```
Config your database in app/config/parameters.yml
php bin/console doctrine:database:create

Update Schema
php bin/console doctrine:schema:update --force

And then manualy  import sql insert data from ./database/city.sql
```

### Run app
```
php bin/console server:run
```

