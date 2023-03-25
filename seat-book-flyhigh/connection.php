<?php
    $dsn="mysql:host=localhost;dbname=std005or_afrs";
    $user="std005orisysacad";
    $password="?*_~ciz4_eWP";
    $options=[];
    try { 
        $connection=new PDO($dsn,$user,$password,$options);
        // echo "connection successful";
    
    } 
    catch(PDOException){
        echo "connection error";
    }
?>