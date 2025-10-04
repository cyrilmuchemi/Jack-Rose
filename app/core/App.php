<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';

    private function split_URL(){
        $URL = isset($_GET["url"]) ? trim($_GET["url"], "/") : "home";
        $URL = explode("/", trim($URL, "/"));
        return $URL;
    }

    public function load_controller(){
        $URL = $this->split_URL();
        $file_name = "../app/controllers/".ucfirst($URL[0]).".php";

        /**select controller */

        if(file_exists($file_name)){
            require $file_name;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        }else{
            $file_name = "../app/controllers/_404.php";
            require $file_name;
            $this->controller = "_404";
        }

        $controller = new $this->controller;

        /**selct method */

        if(!empty($URL[1])){
            if(method_exists($controller, $URL[1])){
                $this->method = $URL[1]; 
                unset($URL[1]);
            }
        }

        call_user_func_array([$controller, $this->method], $URL);
    }

}

