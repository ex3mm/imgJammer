<?php
set_time_limit(0);

$compress = 90; // %
$timeStart = time();

// Get all folders
// Search images and compress
foreach (getAllFolders(__DIR__) as $folder){
    echo PHP_EOL.time()." - dir - ".$folder.PHP_EOL;

    // Search images in folder
    $images = glob($folder.'/*.{JPG,jpg,JPEG,jpeg}', GLOB_BRACE); // array / full path

    foreach ($images as $image){
        echo time()." - compressing image - ".$image.PHP_EOL;
        compress($image, $image, $compress);
    }
}

// Show work time
$workTime = time() - $timeStart;
echo PHP_EOL."Script work time: $workTime";

///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////    FUNCTIONS    /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

// Get all folders
function getAllFolders($path, $_base_path = null)
{
    if (is_null($_base_path)) {
        $_base_path = '';
    } else {
        $_base_path .= basename($path) . '/';
    }
    $out = array();
    foreach(glob($path . '/*', GLOB_ONLYDIR) as $file) {
        if (is_dir($file)) {
            $out[] = $_base_path . basename($file);
            $out = array_merge($out, getAllFolders($file, $_base_path));
        }
    }
    return $out;
}

// Compressor
function compress($source, $destination, $compress) {

    $info = getimagesize($source);

    // JPEG
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    else
        return false;

    // Save
    imagejpeg($image, $destination, $compress);
    return $destination;
}

