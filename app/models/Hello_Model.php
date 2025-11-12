<?php

class Hello_Model
{
    use Model;

    protected $table = 'hello_table';

    protected $allowedColumns = [
        'image',
        'name',
        'person_description'
    ];

    public function validate($files_data, $post_data, $id = null)
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
           $files_data = $_FILES['image']['type'];

           if(!in_array($files_data, $allowed_types)){
            $this->errors['image'] = "Only files of this type are allowed: " . implode(", ", $allowed_types);
           }
        }

        if(empty($post_data['name'])){
            $this->errors['name'] = "Name is required";
        }

        if(empty($post_data['person_description'])){
            $this->errors['person_description'] = "Person description is required";
        }

        return empty($this->errors);
    }

    public function compress_image($source, $destination, $quality = 75){

        $info = getimagesize($source);

        if($info['mime'] === 'image/jpeg'){

            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $destination, $quality);

        }elseif($info['mime'] === 'image/png'){

            $image = imagecreatefrompng($source);
            $png_quality = 9 - floor($quality / 10);
            imagepng($image, $destination, $quality);

        }else if($info['mime'] === 'image/webp'){

            $image = imagecreatefromwebp($source);
            imagewebp($image, $destination, $quality);

        }else if($info['mime'] === 'image/gif'){
            copy($source, $destination);
            return;
        }

        imagedestroy($image);
    }

    public function create_table(){
        $query = "create table if not exists hello_table(
        id int primary key auto_increment,
        image varchar(1024) null,
        name varchar(50) not null,
        person_description varchar(1024) not null
        )";

        $this->query($query);
    }
}