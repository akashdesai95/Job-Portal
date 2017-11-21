<?php

    session_start();
    session_destroy();
    
    header('Location: http://localhost/PHPProject/home.php');
    
?>