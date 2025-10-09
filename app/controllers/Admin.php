<?php

class Admin extends Controller
{
    public function index(){
        redirect('login');
        $this->view('admin');
    }
}