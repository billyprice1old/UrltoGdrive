<?php
if ($handle = opendir('split')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != ".." && $entry != ".gitignore") {
            echo $entry.' <a href="gdrive.php?file='.$entry.'">Upload to google drive</a> <hr />';
        }
    }

    closedir($handle);
}
