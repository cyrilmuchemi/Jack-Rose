<?php

class Admin extends Controller
{
    public function index(){
        $user = new User();
        //redirect('login');
        $this->view('admin/dashboard');
    }

    public function users($action = ""){
        $user = new User();
        $data['rows'] = $user->findAll();
        $this->view('admin/users', $data);
    }
}