<?php
if ($handle = opendir('upload')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != ".." && $entry != ".gitignore") {
            echo $entry.' <a href="gdrive.php?file='.$entry.'">Upload to google drive</a> 
             | <a href="gdrive.php?delete='.$entry.'">Delete</a> 
            
            <hr />';
        }
    }

    closedir($handle);
}
