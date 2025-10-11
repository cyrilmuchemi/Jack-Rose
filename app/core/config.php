<?php

if($_SERVER['SERVER_NAME'] == 'jack-rose.local'){
    define('DBNAME', 'jack_rose_db');
    define('DBHOST', 'localhost');
    define('DBUSER', 'jackrose_user');
    define('DBPASS', 'Budha2021!');
    define('ROOT', 'http://jack-rose.local');
}else{
    define('ROOT', 'https://www.yourwebsite.com');
}

define('APP_NAME', "My Website");
define('APP_DESC', "Best website alive.");
define('DEBUG', true);