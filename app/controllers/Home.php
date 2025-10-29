<?php

class Home extends Controller
{
    public function index(){
        $contact = new Contact_Model;
        $data['social_links'] = $contact->first(['id'=>1]);
        
        $this->view('home', $data);
    }
}