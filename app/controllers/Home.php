<?php

class Home extends Controller
{
    public function index(){
        $contact = new Contact_Model;
        $data['social_links'] = $contact->first(['id'=>1]);

        $gallery = new Gallery_Model;
        $data['gallery'] = $gallery->findAll();

        $hello = new Hello_Model;
        $data['hello'] = $hello->findAll();

        $aboutMain = new About_Main_Model;
        $aboutPeople = new About_People_Model;

        $data['about_main'] = $aboutMain->first(['id'=>2]);
        $data['people'] = $aboutPeople->findAll();
        
        $this->view('home', $data);
    }
}