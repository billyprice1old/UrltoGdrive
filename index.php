<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);

function chunked_copy($from, $to) {
    # 1 meg at a time, you can adjust this.
    $buffer_size = 1048576; 
    $ret = 0;
    $fin = fopen($from, "rb");
    $fout = fopen($to, "w");
    while(!feof($fin)) {
        $ret += fwrite($fout, fread($fin, $buffer_size));
    }
    fclose($fin);
    fclose($fout);
    return true; # return number of bytes written
}

if (!empty($_POST)) {

    $file_url = $_POST['url'];
    $title = $_POST['title'];
    $split = $_POST['split'];
    
    $newfile = './upload/' . $title;
    //$newfiles = './split/' . $title;
    
    //exec('wget '.$file_url. '-O '.$newfiles);

    if ( chunked_copy($file_url, $newfile) ) {
    	echo "Copy success!";
    }else{
    	echo "Copy failed.";
    }
    
    
    exec('split -b '.$split.'m -d -a 3 upload/' . $title.' split/' . $title . '.');
    
}

include 'index.phtml';
echo '<br />';
include 'upload.php';
?>
