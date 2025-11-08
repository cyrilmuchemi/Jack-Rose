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
        if(!$user->logged_in()) redirect('login');
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

    public function gallery($action = null, $id = null){
        $user = new User();
        $gallery = new Gallery_Model;

        if(!$user->logged_in()) redirect('login');
        $data['action'] = $action;
        $data['rows'] = $gallery->findAll();

        if($action == 'new'){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($gallery->validate($_FILES)) {
                    $folder = "uploads/";

                    if(!file_exists($folder)){
                        mkdir($folder, 0777, true);
                    }

                    $destination = $folder . time() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                    $gallery->compress_image($destination, $destination, 70);

                    $_POST['image'] = $destination;
                    $gallery->insert($_POST);
                    redirect('admin/gallery');
                } else {
                    $data['errors'] = $gallery->errors;
                }
            }
        }else if($action == 'edit'){
            $data['row'] = $gallery->first(['id' => $id]);

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if($gallery->validate($_POST, $id)){
                    if(!empty($_FILES['image']['name'])){
                        $folder = "uploads/";

                        if (!empty($row->image) && file_exists($row->image)) {
                            unlink($row->image);
                        }

                        if(!file_exists($folder)){
                            mkdir($folder, 0777, true);
                        }

                        $newImageName = time() . "_" . $_FILES['image']['name'];
                        $destination = $folder . $newImageName;

                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                        $gallery->compress_image($destination, $destination, 70);


                        $dataToUpdate['image'] = $destination;
                    }else{
                        $dataToUpdate['image'] = $data['row']->image;
                    }

                    $gallery->update($id, $dataToUpdate);
                    redirect('admin/gallery');
                }else{
                    $data['errors'] = $gallery->errors;
                }
            }
        }else if($action == 'delete'){
            $data['row'] = $gallery->first(['id'=>$id]);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $gallery->delete($id);
                    if(file_exists($data['row']->image)) unlink($data['row']->image);
                    $gallery->delete($id);
                    redirect('admin/gallery');
                }
        }
            $this->view('admin/gallery', $data);
    }

    public function contact($action = null, $id = null){
    $user = new User();
    $contact = new Contact_Model();
    $contact->create_table();

    if (!$user->logged_in()) redirect('login');

    $data['action'] = $action;
    $data['rows'] = $contact->findAll();

    if ($action == 'edit') {
        $data['row'] = $contact->first(['id' => $id]);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($contact->validate($_POST, $id)) {
                if ($data['row']) {
                    $contact->update($id, $_POST);
                } else {
                    $contact->insert($_POST);
                }

                redirect('admin/contact');
            } else {
                $data['errors'] = $contact->errors;
            }
        }
    }

    $this->view('admin/contact', $data);
}

}