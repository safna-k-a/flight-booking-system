
<?php
    session_start();
    if(!isset($_SESSION['email'])) {
        header("Location:../login.php");
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

<?php
    require "footer.php";
?>
