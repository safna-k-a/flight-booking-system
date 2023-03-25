<?php
    require '../../connection.php';
?> 
<?php
    require '../../header.php';
    $id=$_GET['id'];
    $sql='SELECT * FROM flight WHERE id=:id';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$id]);
    $flight=$statement->fetch(PDO::FETCH_OBJ);
    $airline=$flight->airline_id;
    $sql='SELECT * FROM airline WHERE id=:id';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$airline]);
    $airlines=$statement->fetch(PDO::FETCH_OBJ);
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $air_line=$_POST['airline_name'];
        $total_seat=$_POST['total_seat'];
        $edited_by='admin';

        $sql='SELECT * FROM airline WHERE name=:name';
        $statement=$connection->prepare($sql);
        $statement->execute([':name'=>$air_line]);
        $airline=$statement->fetch(PDO::FETCH_OBJ);
        $airid=$airline->id;

        $sq='SELECT * FROM flight WHERE name=:name AND airline_id=:air';
        $sta=$connection->prepare($sq);
        $sta->execute([':name'=>$name,':air'=>$airid]);
        $sq_fetch=$sta->fetch(PDO::FETCH_OBJ);
        if($sq_fetch)
        {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Flight already exist!',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='flights.php';
              });

            </script>";  
        }
        else{
            $sql='UPDATE flight SET name=:name,airline_id=:airline,total_seat=:total_seat,edited_by=:edited where id=:id';
            $statement=$connection->prepare($sql);
            if($statement->execute([':name'=>$name,':airline'=>$airline->id,':total_seat'=>$total_seat,':edited'=>$edited_by,':id'=>$id])){
                echo "<script>
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Updated Successfully',
                    showConfirmButton: false,
                    timer: 2000
                  }).then(function(){
                    window.location='flights.php';
                  });
    
                </script>";
            }
        }
        
    }
?>
<div class="container row justify-content-center min-vh-100">
    <div class="col-md-3"></div>
    
<div class=" col-md-8 col-10 form  mt-5 ms-5 dark bg-opacity-25 p-5  ">
<form action="" method="POST" onsubmit="return validate()" class="">
    <div class="mt-3"><input type="text" value="<?=$flight->name ?>" class="form-control" name="name" id=""></div>
    
    <div class="mt-3"><input type="text" value="<?=$airlines->name?>" class="form-control" name="airline_name" id=""></div>

    <div class="mt-3"><input type="text" value="<?=$flight->total_seat ?>" class="form-control" name="total_seat" id=""></div>

    <div class="text-center mt-3"><input type="submit" value="submit" class="btn btn-primary" name="submit"></div>
</form>
</div>
<?php

    require '../../footer.php';
    
?>