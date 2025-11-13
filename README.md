>**IMPORTANT**: Make sure you have composer installed<br> Download composer here https://getcomposer.org/download <br><br>
>**IMPORTANT**: Make sure you have php-pdo extension<br> If you encounter pdo not found errors follow the instuction based on your OS https://www.php.net/manual/en/book.pdo.php 
## Step 1
CD into the yoursuprise-api folder and paste these commands into your cmd
```sh
composer install
cp .env.example .env
php artisan key:generate
```
In the .env file make sure this line is changed to cookie SESSION_DRIVER=cookie<br><br>
Afterwards you can paste this command
```sh
php artisan serve
```
## Step 2
CD into the yoursurprise-frontend and past these commands into your cmd
```sh
npm install
npm run dev -- --open
```
