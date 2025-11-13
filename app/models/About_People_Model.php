<?php

class About_People_Model
{
    use Model;

    protected $table = 'about_people_table';

    protected $allowedColumns = [                
        'image',
        'name',
        'role',
        'person_description',
        'twitter_link',
        'facebook_link',
        'instagram_link',
        'linkedin_link',
    ];

    public function validate($files_data, $post_data, $id = null){
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


    public function compress_image($source, $destination, $quality = 75)
    {
        $info = getimagesize($source);

        switch ($info['mime']) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                imagejpeg($image, $destination, $quality);
                break;

            case 'image/png':
                $image = imagecreatefrompng($source);
                $png_quality = 9 - floor($quality / 10);
                imagepng($image, $destination, $png_quality);
                break;

            case 'image/webp':
                $image = imagecreatefromwebp($source);
                imagewebp($image, $destination, $quality);
                break;

            case 'image/gif':
                copy($source, $destination);
                return;

            default:
                return;
        }

        imagedestroy($image);
    }

    public function create_table()
    {
         $query = "create table if not exists about_people_table(
            id int primary key auto_increment,
            image varchar(1024) null,
            name varchar(50) not null,
            role varchar(50) not null,
            person_description varchar(1024) not null,
            twitter_link varchar(1024) null,
            facebook_link varchar(1024) null,
            instagram_link varchar(1024) null,
            linkedin_link varchar(1024) null
        )";

        $this->query($query);
    }
}
