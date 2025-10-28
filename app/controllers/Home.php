<?php

class Home extends Controller
{
    public function index(){
        $contact = new Contact_Model;
        $data['social_links'] = $contact->where(['id'=>1]);
        show($data['social_links']); die;
        $this->view('home');
    }
}