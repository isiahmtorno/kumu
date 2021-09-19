<strong>Instructions:</strong><br>
Clone <a href="https://github.com/laradock/laradock" target="_blank">laradock</a> in your project directory<br>
Build docker container using:<br>
docker compose up -d nginx phpmyadmin redis redis-webui<br>
docker-compose exec workspace bash<br>

Inside workspace bash setup or install:<br> 
composer install<br>
php artisan migrate<br>
php artisan passport:install<br>

API's<br>
Register<br>
http://localhost/api/register - POST<br>
Params:<br>
name (string)<br>
email (string)<br>
password (string)<br>
password_confirmation (string)<br>

Login (token will generate after logged in, then put the token in Authorization (Bearer Token) Type)<br>
http://localhost/api/login - POST<br>
Params:<br>
email (string)<br>
password (string)<br>

API request for github username(s)<br>
http://localhost/api/github - POST<br>
Sample JSON Request:<br>
<pre>{
    "usernames": [
        "ben",
        "jfrost",
        "alex",
        "testing",
        "testing33333"
    ]
}</pre>

Logout<br>
http://localhost/api/login - POST<br>
