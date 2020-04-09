<?php

function compress($source, $destination, $quality)
{
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') :
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif') :
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png') :
        $image = imagecreatefrompng($source);
    endif;

    $image = imagescale($image, 320, 240);

    imagejpeg($image, $destination, $quality);

    return $destination;
}
