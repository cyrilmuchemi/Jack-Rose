<?php

class Gallery_Model
{
    use Model;

    protected $table = 'gallery_table';

    protected $allowedColumns = [
        'image',
    ];

    public function validate($data, $id = null)
    {
        $allowed_types = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
        ];

        if(empty($data['file']['name'])){
            $this->errors['image'] = "An image is required";
        }else{
            if(!in_array($data['file']['type'], $allowed_types)){
                $this->errors['image'] = "Only files of this type are allowed: ". implode(",", $allowed_types);
            }
        }

        $this->errors = [];

        if(empty($this->errors)){
            return true;
        }

        return false;
    }

    public function create_table(){
        $query = "create table if not exists gallery_table(
        id int primary key auto_increment,
        image varchar(1024) null
        )";

        $this->query($query);
    }
}