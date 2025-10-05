<?php

if($_SERVER['SERVER_NAME'] == 'jack-rose.local'){
    define('DBNAME', 'my_db');
    define('DBHOST', '127.0.0.1');
    define('DBUSER', 'mvcuser');
    define('DBPASS', 'Budha2021!');
    define('ROOT', 'http://jack-rose.local');
}else{
    define('ROOT', 'https://www.yourwebsite.com');
}

define('APP_NAME', "My Website");
define('APP_DESC', "Best website alive.");
define('DEBUG', true);