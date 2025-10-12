<?php

class Admin extends Controller
{
    public function index(){
        $user = new User();
        $user->create_table();
        //redirect('login');
        $this->view('admin/dashboard');
    }

    public function users(){
        $this->view('admin/users');
    }
}