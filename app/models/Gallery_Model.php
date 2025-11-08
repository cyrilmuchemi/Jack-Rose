<?php

class Gallery_Model
{
    use Model;

    protected $table = 'gallery_table';

    protected $allowedColumns = ['image'];

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
        $query = "create table if not exists gallery_table(
        id int primary key auto_increment,
        image varchar(1024) null
        )";

        $this->query($query);
    }
}