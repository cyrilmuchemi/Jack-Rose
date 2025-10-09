<?php

function show($stuff){
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function escape($str){
    return htmlspecialchars($str);
}

function redirect($path){
    header("Location: " . ROOT . "/" .$path);
    die;
}