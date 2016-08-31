<?php

if (!empty($_POST)) {

    $file_url = $_POST['url'];
    $title = $_POST['title'];
    $split = $_POST['split'];
    
    $newfile = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $title;

    if ( copy($file, $newfile) ) {
    	echo "Copy success!";
    }else{
    	echo "Copy failed.";
    }
    
    sleep(10);
    
    exec('split -d -b '.$split.'m /upload/' . $title.' split/pieces');
    
}


?>
