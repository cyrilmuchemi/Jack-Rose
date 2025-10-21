<?php

class Logout extends Controller
{
    public function index(){
        $user = new User;
        $user->logout;
        redirect('home');
    }
}