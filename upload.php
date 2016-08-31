<?php
if ($handle = opendir('split')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            echo "$entry <br />";
        }
    }

    closedir($handle);
}
