<?php
$myfile = fopen("../../files/newfile.txt", "w") or die("Unable to open file!");
$txt = "Mickey Mouse\n";
fwrite($myfile, $txt);
fclose($myfile);
