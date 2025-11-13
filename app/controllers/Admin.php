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

    public function hello($action = null, $id = null){
        $user = new User();
        $hello = new Hello_Model;
       
        if(!$user->logged_in()) redirect('login');
        $data['action'] = $action;
        $data['rows'] = $hello->findAll();

        if($action == 'new'){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($hello->validate($_FILES, $_POST)) {
                    $folder = "uploads/";

                    if(!file_exists($folder)){
                        mkdir($folder, 0777, true);
                    }

                    $destination = $folder . time() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                    $hello->compress_image($destination, $destination, 70);

                    $_POST['image'] = $destination;
                    $hello->insert($_POST);
                    redirect('admin/hello');
                } else {
                    $data['errors'] = $hello->errors;
                }
            }
        }else if($action == 'edit'){
            $data['row'] = $hello->first(['id' => $id]);

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if($hello->validate($_POST, $_POST, $id)){
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

                        $hello->compress_image($destination, $destination, 70);


                        $dataToUpdate['image'] = $destination;
                    }else{
                        $dataToUpdate['image'] = $data['row']->image;
                    }

                    $hello->update($id, $dataToUpdate);
                    redirect('admin/hello');
                }else{
                    $data['errors'] = $hello->errors;
                }
            }
        }else if($action == 'delete'){
            $data['row'] = $hello->first(['id'=>$id]);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $hello->delete($id);
                    if(file_exists($data['row']->image)) unlink($data['row']->image);
                    $hello->delete($id);
                    redirect('admin/hello');
                }
        }
            $this->view('admin/hello', $data);
    }

    public function about_main($action = null, $id = null){
            $user = new User();
            $aboutMain = new About_Main_Model;

            if (!$user->logged_in()) redirect('login');

            $data['action'] = $action;
            $data['rows'] = $aboutMain->findAll();

            if ($action == 'new') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($aboutMain->validate($_FILES, $_POST)) {
                        $folder = "uploads/";

                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }

                        $destination = $folder . time() . "_" . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                        $aboutMain->compress_image($destination, $destination, 70);

                        $_POST['image'] = $destination;
                        $aboutMain->insert($_POST);

                        redirect('admin/about_main');
                    } else {
                        $data['errors'] = $aboutMain->errors;
                    }
                }
            } elseif ($action == 'edit') {
                $data['row'] = $aboutMain->first(['id' => $id]);

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($aboutMain->validate($_FILES, $_POST, $id)) {

                        $dataToUpdate = [
                            'about_title' => $_POST['about_title'],
                            'about_description' => $_POST['about_description'],
                            'phone' => $_POST['phone'] ?? null,
                        ];

                        if (!empty($_FILES['image']['name'])) {
                            $folder = "uploads/";

                            if (!file_exists($folder)) {
                                mkdir($folder, 0777, true);
                            }

                            if (!empty($data['row']->image) && file_exists($data['row']->image)) {
                                unlink($data['row']->image);
                            }

                            $destination = $folder . time() . "_" . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                            $aboutMain->compress_image($destination, $destination, 70);

                            $dataToUpdate['image'] = $destination;
                        } else {
                            $dataToUpdate['image'] = $data['row']->image;
                        }

                        $aboutMain->update($id, $dataToUpdate);
                        redirect('admin/about_main');
                    } else {
                        $data['errors'] = $aboutMain->errors;
                    }
                }
            } elseif ($action == 'delete') {
                $data['row'] = $aboutMain->first(['id' => $id]);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (file_exists($data['row']->image)) unlink($data['row']->image);
                    $aboutMain->delete($id);
                    redirect('admin/about_main');
                }
            }

            $this->view('admin/about_main', $data);
    }

    public function about_people($action = null, $id = null){
        $user = new User();
        $aboutPeople = new About_People_Model;

        if (!$user->logged_in()) redirect('login');

        $data['action'] = $action;
        $data['rows'] = $aboutPeople->findAll();

        if ($action == 'new') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($aboutPeople->validate($_FILES, $_POST)) {
                    $folder = "uploads/";

                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    $destination = $folder . time() . "_" . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    $aboutPeople->compress_image($destination, $destination, 70);

                    $_POST['image'] = $destination;
                    $aboutPeople->insert($_POST);

                    redirect('admin/about_people');
                } else {
                    $data['errors'] = $aboutPeople->errors;
                }
            }
        } elseif ($action == 'edit') {
            $data['row'] = $aboutPeople->first(['id' => $id]);

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($aboutPeople->validate($_FILES, $_POST, $id)) {

                    $dataToUpdate = [
                        'name' => $_POST['name'],
                        'role' => $_POST['role'] ?? '',
                        'person_description' => $_POST['person_description'],
                        'twitter_link' => $_POST['twitter_link'] ?? '',
                        'facebook_link' => $_POST['facebook_link'] ?? '',
                        'instagram_link' => $_POST['instagram_link'] ?? '',
                        'linkedin_link' => $_POST['linkedin_link'] ?? '',
                    ];

                    if (!empty($_FILES['image']['name'])) {
                        $folder = "uploads/";

                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }

                        if (!empty($data['row']->image) && file_exists($data['row']->image)) {
                            unlink($data['row']->image);
                        }

                        $destination = $folder . time() . "_" . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                        $aboutPeople->compress_image($destination, $destination, 70);

                        $dataToUpdate['image'] = $destination;
                    } else {
                        $dataToUpdate['image'] = $data['row']->image;
                    }

                    $aboutPeople->update($id, $dataToUpdate);
                    redirect('admin/about_people');
                } else {
                    $data['errors'] = $aboutPeople->errors;
                }
            }
        } elseif ($action == 'delete') {
            $data['row'] = $aboutPeople->first(['id' => $id]);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (file_exists($data['row']->image)) unlink($data['row']->image);
                $aboutPeople->delete($id);
                redirect('admin/about_people');
            }
        }

        $this->view('admin/about_people', $data);
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