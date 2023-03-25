<?php
    require '../../connection.php';
?> 
<?php
    require '../../header.php';
    $id=$_GET['id'];
    $sql='SELECT * FROM airline WHERE id=:id';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$id]);
    $airline=$statement->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])){
        $name=$_POST['airline_name'];
        $edited_by='admin';

        $sql='SELECT * FROM airline WHERE name=:name';
        $sta=$connection->prepare($sql);
        $sta->execute([':name'=>$name]);
        $sql_fetch=$sta->fetch(PDO::FETCH_OBJ);
        
        if($sql_fetch)
        {
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Airline Already Exists!',
            showConfirmButton: false,
            timer: 2000
          }).then(function(){
            window.location='update.php';
          });
        </script>";    
        }
        else
        {
            $sql='UPDATE airline SET name=:name,edited_by=:edited where id=:id';
            $statement=$connection->prepare($sql);
            if($statement->execute([':name'=>$name,':edited'=>$edited_by,':id'=>$id])){
                echo "<script>
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Updated Successfully',
                    showConfirmButton: false,
                    timer: 2000
                  }).then(function(){
                    window.location='update.php';
                  });
    
                </script>";
            }
        }
        
    }
?>
<div class="form w-50 mt-5 ms-5 bg-primary bg-opacity-25 p-5">
<form action="" method="POST" onsubmit="return validate()" class="">
    <div class="mt-3"><input type="text" value="<?=$airline->name ?>" class="form-control" name="airline_name" id=""></div>

    <div class="text-center mt-3"><input type="submit" value="submit" class="btn btn-primary" name="submit"></div>
</form> 
<?php

    require '../../footer.php';
    
?>