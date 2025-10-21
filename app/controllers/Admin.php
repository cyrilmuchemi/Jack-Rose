<?php

class Admin extends Controller
{
    public function index(){
        $user = new User();
        if(!$user->logged_in()) redirect('login');
        $this->view('admin/dashboard');
    }

    public function users($action = null, $id = null){
        $user = new User();
        $data['action'] = $action;
        $data['rows'] = $user->findAll();

            if($action == 'new'){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($user->validate($_POST)) {
                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $user->insert($_POST);
                        redirect('admin/users');
                    } else {
                        $data['errors'] = $user->errors;
                    }
                }
            }else if($action == 'edit'){
                $data['row'] = $user->first(['id'=>$id]);
               if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($user->validate($_POST, $id)) {
                        if(empty($_POST['password'])){
                            unset($_POST['password']);
                        }else{
                            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        }
                        $user->update($id, $_POST);
                        redirect('admin/users');
                    } else {
                        $data['errors'] = $user->errors;
                    }
                }
            }else if($action == 'delete'){
                $data['row'] = $user->first(['id'=>$id]);
                 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $user->delete($id);
                    redirect('admin/users');
                 }
            }
                $this->view('admin/users', $data);
    }
}