<?php

class About_Main_Model
{
    use Model;

    protected $table = 'about_main_table';

    protected $allowedColumns = [                
        'image',
        'about_title',
        'about_description',
        'phone'
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

        if(empty($post_data['about_title'])){
            $this->errors['about_title'] = "Title is required";
        }

        if(empty($post_data['about_description'])){
            $this->errors['about_description'] = "About description is required";
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
        $query = "CREATE TABLE IF NOT EXISTS about_main_table(
            id INT PRIMARY KEY AUTO_INCREMENT,
            about_title TEXT NOT NULL,
            about_description TEXT NOT NULL,
            phone VARCHAR(50) NULL
        )";

        $this->query($query);
    }
}
