<?php

session_start();

getProgress($_GET['title']);

function getProgress($filename) {
    if (isset($_SESSION[$filename])) {
        echo json_encode(array("progress" => $_SESSION[$filename]));
    } else {
        echo json_encode(array("progress" => -1));
//        echo json_encode('could not find file:'.$filename);
    }
}

?>
