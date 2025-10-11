<?php

class User
{
    use Model;

    protected $allowedColumns = [
        'username',
        'email',
        'password'
    ];

    public function validate(){
        $this->errors = [];

        if(empty($data['email'])){
            $this->errors['email'] = 'Email is required';
        }else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = "Email is not valid";
        }

        if(empty($data['password'])){
            $this->errors['password'] = "Password is required";
        }

        if(empty($this->errors)){
            return true;
        }

        return false;
    }

    public function create_table(){
        $query = "create table if not exists users(
        id int primary key auto_increment,
        username varchar(30) not null,
        password varchar(255) not null,
        email varchar(100) not null,
        
        key email (email)
        )";
    }
}