<?php

class Login extends Controller
{
    public function index(){

        $data['errors'] = [];
        $row = null;

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user = new User;
            $row = $user->first(['email' => $_POST['email']]);

            if($row && password_verify($_POST['password'], $row->password)){
                $user->authenticate($row);
                redirect('admin');
            }else{
                $data['errors']['email'] = "Wrong email or password!";
            }
        }

        $this->view('login', $data);
    }
}