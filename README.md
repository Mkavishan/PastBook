

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
    
5. You need to create https tunnel using ngrok for the local setup. 
    - **[Ngrok Download](https://ngrok.com/download)**
   
6. Set the .env file APP_URL after creating https tunnel.
    - ex : APP_URL=https://eeba-112-134-110-212.ngrok.io
    
7. Run below commands from root folder (need to install composer locally)
    - composer install
    - php artisan migration
    - php artisan serve
    
8. Then you can navigate to app **[here](http://127.0.0.1:8000)**
    - http://127.0.0.1:8000
