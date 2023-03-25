<?php
session_start();
require 'connection.php' ?>
<?php

$email=$_SESSION['email'];
$sql='SELECT * from register where email=:email LIMIT 1';
$statement=$connection->prepare($sql);
$statement->execute([':email'=>$email]);
$user=$statement->fetch(PDO::FETCH_OBJ);
$_SESSION['name']=$user->name;
$_SESSION['photo']=$user->photo;
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    echo "<script>window.location.href='../login.php'</script>";
    
}
 require 'header.php';
require 'footer.php';
 ?>
