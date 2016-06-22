<?php

$data = $_POST["data"];

$adminfile = 'textdata/admin.txt';
$handle = fopen($adminfile, 'w') or die('Cannot open file:  '.$adminfile);
if ($data == 0) {
    $data = '1';
}
else {
    $data = '0';
}

fwrite($handle, $data);
fclose($handle);
header("location:admin.php?");