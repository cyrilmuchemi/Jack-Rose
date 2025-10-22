<?php

class Logout extends Controller
{
    public function index(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $user = new User;
        $user->logout();

        session_destroy();
        redirect('login');
        exit;
    }
}