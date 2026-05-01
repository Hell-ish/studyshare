<?php

if(isset($_GET['file'])){

    $file = basename($_GET['file']);
    $path = "uploads/" . $file;

    if(file_exists($path)){
        echo "<iframe src='$path' width='100%' height='600px'></iframe>";
    } else {
        echo "File not found!";
    }
}
?>