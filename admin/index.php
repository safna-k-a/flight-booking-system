<?php
    session_start();
    
    if(!isset($_SESSION['email'])) {
        echo "<script>window.location.href='../login.php';</script>";
    }
    require 'connection.php';
    require "header.php";
    $email=$_SESSION['email'];
    $sql='SELECT * from register where email=:email LIMIT 1';
    $statement=$connection->prepare($sql);
    $statement->execute([':email'=>$email]);
    $user=$statement->fetch(PDO::FETCH_OBJ);
?>
<h1><?= $user->name ?></h1>
<div class="min-vh-100"></div>
<?php
    require "footer.php";
?>