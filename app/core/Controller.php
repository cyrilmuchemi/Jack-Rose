<?php

class Controller 
{
    public function view($name){

        $file_name = "../app/views/".$name.".view.php";

        if(file_exists($file_name)){
            require $file_name;
        }else{
            $file_name = "../app/views/404.view.php";
            require $file_name;
        }
    }
}