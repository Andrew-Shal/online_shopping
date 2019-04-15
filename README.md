# Online Shopping

##server requirements:

1. PHP >= 7.1.3
1. OpenSSL PHP Extension
1. PDO PHP Extension
1. Mbstring PHP Extension
1. Tokenizer PHP Extension
1. XML PHP Extension
1. Ctype PHP Extension
1. JSON PHP Extension
1. BCMath PHP Extension

## Installation

1. download and install xampp link: https://www.apachefriends.org/index.html
1. Clone the repo link: https://github.com/Andrew-Shal/online_shopping
1. paste into xampp htdocs folder `cd C:\xampp\htdocs`
1. rename repo folder to `online_shopping` and `cd` into it
1. install composer.phar or composer.exe link: https://getcomposer.org/download/
1. `composer install`
1. Rename or copy `.env.example` file to `.env`
1. `php artisan key:generate`
1. start web server and mysql server from xampp gui panel
1. navigate to http://127.0.0.1/phpmyadmin/index.php
1. create a database in phpmyadmin called `laravel_online_shopping`
1. Set your database credentials and mail server settings in your `.env` file
1. `npm install`
1. `npm run dev`
1. copy file `httpd-vhosts.conf` and paste in `cd C:\xampp\apache\conf\extra\`
1. navigate to system32 folder `cd C:\WINDOWS\System32\drivers\etc` and paste the following below:
1. 127.0.0.1 localhost
1. 127.0.0.1 shopping.build
1. navigate to `shopping.build` in the browser

## Operating instructions

1. xampp (a localhost web server, mysql server)
1. visual studio code (editor)
1. google chrome (web browser)

1. turn on xampp
1. open code folder in visual studio code
1. check the route you want to run in the web browser
1. type in the url of the browser shopping.build/product
1. products is the screen that shows items that is uploaded by the seller.

Copyright and licensing information
The Laravel framework is open-source software licensed under the MIT license.

Contact information for the distributor or programmer
Allando, Andew Shal, Danay, Delroy Coc, George
