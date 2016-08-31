<?php

copyfiles($_POST['url'], $_POST['title']);


function copyfiles($from, $to) {

    $buffer_size = 500000; 
    $ret = 0;
    $fsize = file_size($from);
    
    $_SESSION[$to] = $ret;
    $fin = fopen($from, "rb");
    $fout = fopen('upload/'.$_POST['title'], "w");
    while(!feof($fin)) {
        session_start();
        sleep(1);
        $cont += fwrite($fout, fread($fin, $buffer_size));
        if($fsize != null){
           $ret = = min(100, 100 * $cont / $fsize);
        }else{
           $ret = $cont;
        }
        $_SESSION[$to] = $ret;
        session_write_close();
    }
    fclose($fin);
    fclose($fout);
    session_start();
    unset($_SESSION[$to]); //completed copy

}


function copyfiless($filename, $filesize) {
    echo json_encode('copying ' . $filename);
}

function file_size($file){
    $ch = curl_init($file);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $data = curl_exec($ch);
    curl_close($ch);

    if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
        $contentLength = (int)$matches[1];
    }else{
        $contentLength = null;
    }
    
    echo $contentLength;
}
?>

