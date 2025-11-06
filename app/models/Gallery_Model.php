<?php

class Gallery_Model
{
    use Model;

    protected $table = 'gallery_table';

    public function validate($data, $id = null)
    {
        $allowed_types = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
        ];

        if(empty($_FILES['image']['name'])){
            $this->errors['image'] = "An image is required";
        }else{
           $file_type = $_FILES['image']['type'];

           if(!in_array($file_type, $allowed_types)){
            $this->errors['image'] = "Only files of this type are allowed: " . implode(", ", $allowed_types);
           }
        }

        return empty($this->errors);
    }

    public function create_table(){
        $query = "create table if not exists gallery_table(
        id int primary key auto_increment,
        image varchar(1024) null
        )";

        $this->query($query);
    }
}