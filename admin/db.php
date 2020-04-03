<?php
    
    /* database connection setting */
    $host= 'localhost' ; 
    $username = 'root' ;
    $password = '' ; 
    $db = 'shohrab' ;

    $mysqli = new mysqli($host , $username , $password , $db) or die($mysqli->error);
