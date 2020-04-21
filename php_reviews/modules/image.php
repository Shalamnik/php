<?php

class Image
{
    private $img_size;
    private $img_type;
    private $img_path;
    private $img_name;
    private $upload_path = 'images/';

    public function __construct($img_data)
    {
        $this->img_type = $img_data['type'];
        $this->img_path = $img_data['tmp_name'];
        $this->img_name = $img_data['name'];
        $this->img_size = getimagesize($this->img_path);
        $this->upload_path .= $img_data['name'];
    }

    private function compressImg()
    {
        if ($this->img_type == 'image/jpeg') :
            $image = imagecreatefromjpeg($this->img_path);
        elseif ($this->img_type == 'image/gif') :
            $image = imagecreatefromgif($this->img_path);
        elseif ($this->img_type == 'image/png') :
            $image = imagecreatefrompng($this->img_path);
        endif;

        $image = imagescale($image, 320, 240);
        $destination = $this->img_path;
        
        imagejpeg($image, $destination, 75);

        return $destination;
    }

    public function validateImg()
    {
        if ($this->checkType($this->img_type)) {
            if ($this->checkSize($this->img_size)) {
                return $this->img_path;
            } else {
                $img = $this->compressImg();
                return $img;
            }
        } else {
            $this->img_name = null;
            return $this->img_name;
        }
    }

    public function addImg()
    {
        $img = $this->validateImg();
        move_uploaded_file($img, $this->upload_path);
        
        return $this->upload_path;
    }

    public function getName()
    {
        return $this->img_name;
    }

    private function checkType($img_type)
    {
        if (
            $img_type === 'image/png' ||
            $img_type === 'image/jpeg' ||
            $img_type === 'image/gif'
        ) {
            return true;
        } else {
            return false;
        }
    }

    private function checkSize($img_size)
    {
        $img_width = $img_size[0];
        $img_height = $img_size[1];

        if ($img_width > 320 || $img_height > 240) {
            return false;
        } else {
            return true;
        }
    }
}
