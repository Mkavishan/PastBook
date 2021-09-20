

## PastBook

## Installing

1. Clone the repository from GitHub
- **[PassBook](https://github.com/Mkavishan/PastBook.git)**

2. Create a database with name 'past_book'.

3. Get a copy from .env.example file and save it as .env and change the database configuration with correct values.
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3308
    - DB_DATABASE=past_book
    - DB_USERNAME=root
    - DB_PASSWORD=

4. Generate facebook configuration values and add to the .env. **[Facebook for developers](https://developers.facebook.com/apps)**
    - FACEBOOK_CLIENT_ID=
    - FACEBOOK_CLIENT_SECRET=
    
5. Run below commands from root folder (need to install composer locally)
    - composer install
    - php artisan migration
    - php artisan serve
