<?php
    //connect to database
    $conn = mysqli_connect('localhost', 'Amardeep', '07localhost07', 'tech_house');

    // check connection
    if(!$conn){
        echo 'Connection error :('. mysqli_error();
    }

?>