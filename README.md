# Online Shopping

to see recommendations, you have to add ratings to products,
the more you add, the more accurate the results will be. the recommender is based on
the distance in comparison between your ratings and other users that have added ratings to
similar products as you.

the recommendations are generated per user based on their login time,
If a user's last login time is less than (n) when the user currently logs in,
we add a job to the queue to generate recommendations.

The queue is stored in th database under a table called jobs.
when the server is free, it runs jobs that are placed in the queue.

A scheduler runs all the jobs in the queue,

(n) is the offset that can be set to run jobs,
for example, if you go to App/Console/Kernel.php

you will find the schedule function

     protected function schedule(Schedule $schedule)
    {
        $schedule->command('queue:work --stop-when-empty')
            ->everyMinute()->withoutOverlapping();
    }


    here, we have set the scheduler to run the queue worker every minute when
    there's no records in the database table "jobs"

    Where are recommendations generated?

    navigate to :App/Jobs/GenerateRecommendations.php

    here in the handle function is where we genereate recommendations

    How and where is this  GenerateRecommendations called?

    we use dispatch, (GenerateRecommendations uses the trait Dispatchable)

    if you navigate to App/Http/Controllers/Auth/Login.php

    you will find the following

    GenerateRecommendations::dispatch($user, $user->last_login);

    in a function called authenticated

    authenticated is called whenever a user sucessfully logs in.
    and we dispatch GenerateRecommendations with args User::class(current user logged in) and the users last login value(a field in the db users table)


Site url: https://bzhomerentals.com/

1. create an account and verify your email
1. once verified, you will be redirected to the dashboard for buyers
1. you can see several tabs here
1. to get recommendations, you have to add ratings to some products, log out, log back in, the navigate to the recommendations tab in the buyers dashboard (https://bzhomerentals.com/dashboard#recommend)
1. you can also see your recommendations on the landing page, that is if you have any recommendations.



##server requirements:

1. PHP >= 7.1.3
1. OpenSSL PHP Extension
1. xampp

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
