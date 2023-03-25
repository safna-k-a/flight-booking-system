<?php 
    require '../../connection.php';
?>
<?php 
    require '../../header.php';
?>
<?php
    $id=$_GET['id'];
    $sql="DELETE FROM airline WHERE id=:id";
    $statement=$connection->prepare($sql);
    $sql_execute=$statement->execute([':id'=>$id]);
    if($sql_execute)
    {
            echo "<script>alert('Deleted Successfully');document.location='update.php'</script>";
        

    }

?>
<?php 
    require '../../footer.php';
?>