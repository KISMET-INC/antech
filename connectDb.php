<?php
    $conn = mysqli_connect('localhost', 'root','12345Melrose', 'antech');

    if($conn){
        echo 'Connection established:';
    }
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo 'thisphp';
   
?>


