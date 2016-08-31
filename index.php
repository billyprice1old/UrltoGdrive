<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
if (!empty($_POST)) {

    $file_url = $_POST['url'];
    $title = $_POST['title'];
    $split = $_POST['split'];
    
    $newfile = './upload/' . $title;

    if ( copy($file_url, $newfile) ) {
    	echo "Copy success!";
    }else{
    	echo "Copy failed.";
    }
    
    
    exec('split -b '.$split.'m -d -a 3 upload/' . $title.' split/' . $title . '.');
    
}

include 'index.phtml';
?>
