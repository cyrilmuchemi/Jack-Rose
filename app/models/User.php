<?php

class User
{
    use Model;

    protected $table = 'users';

    protected $allowedColumns = [
        'username',
        'email',
        'password'
    ];

    public function validate($data, $id = null)
    {
        $this->errors = [];

        if (empty($data['username'])) {
            $this->errors['username'] = 'Username is required';
        }

        if (empty($data['email'])) {
            $this->errors['email'] = 'Email is required';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        } else {
            // Only check for duplicates if creating a new user or email has changed
            $existing = $this->first(['email' => $data['email']]);
            if ($existing && $existing->id != $id) {
                $this->errors['email'] = "Email is already in use";
            }
        }

        if ($id === null && empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        }

        return empty($this->errors);
    }

    public function authenticate($row)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['USER'] = [
            'id' => $row->id,
            'username' => $row->username,
            'email' => $row->email,
            'role' => $row->role ?? 'user'
        ];
    }

    public function logout(){
        if(!empty($_SESSION['USER'])) unset($_SESSION['USER']);
    }

    public function logged_in(){
        if(!empty($_SESSION['USER'])) return true;
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

        $this->query($query);
    }
}