<?php

class Home extends Controller
{
    public function index(){
        $contact = new Contact_Model;
        $data['social_links'] = $contact->first(['id'=>1]);

        $gallery = new Gallery_Model;
        $data['gallery'] = $gallery->findAll();
        
        $this->view('home', $data);
    }
}