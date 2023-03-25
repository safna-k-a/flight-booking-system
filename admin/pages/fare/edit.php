<?php
    require '../../connection.php';
?> 
<?php
    require '../../header.php';
    $id=$_GET['id'];
    $sql='SELECT * FROM fare WHERE id=:id';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$id]);
    $fare=$statement->fetch(PDO::FETCH_OBJ);
    $flyid=$fare->fly_id;

    $sql='SELECT * FROM fly WHERE id=:id';
    $sta=$connection->prepare($sql);
    $sta->execute([':id'=>$flyid]);
    $flys=$sta->fetch(PDO::FETCH_OBJ);
    $flightid=$flys->flight_id;

    $sql='SELECT * FROM flight WHERE id=:id';
    $sta=$connection->prepare($sql);
    $sta->execute([':id'=>$flightid]);
    $flights=$sta->fetch(PDO::FETCH_OBJ);
    $fname=$flights->name;

    if(isset($_POST['fly_id'])){
        $economy_rate=$_POST['economy_rate'];
        $business_rate=$_POST['business_rate'];
        $a='admin';
        

        $sql='SELECT * FROM fare WHERE fly_id=:fly_id AND economy_rate=:economy_rate AND business_rate=:business_rate';
        $sta=$connection->prepare($sql);
        $sta->execute([':fly_id'=>$fname,':economy_rate'=>$economy_rate,
        ':business_rate'=>$business_rate]);
        $sql_fetch=$sta->fetch(PDO::FETCH_OBJ);
        if($sql_fetch)
        {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'already exists!',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='fare_view.php';
              });

            </script>";   
        }
        else{
            $sql='UPDATE fare set fly_id=:fly_id,economy_rate=:economy_rate,business_rate=:business_rate,edited_by=:eb WHERE id=:id';
            $statement=$connection->prepare($sql);
            $success=$statement->execute([':fly_id'=>$flyid,':economy_rate'=>$economy_rate,
            ':business_rate'=>$business_rate,':id'=>$id,':eb'=>$a]);
            if($success)
            {
                echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Updated Successfully',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='fare_view.php';
              });

            </script>";
            }
        }
        
    }
?>
<div class="container row justify-content-center">
        <div class="col-md-3"></div>
<div class="form col-8  mt-5 ms-5 dark bg-opacity-25 p-5 min-vh-100">
<form action="" method="POST" onsubmit="return fare_validate()" class="">
<div class="mt-3">
    <select name="fly_id" id="" class="form-control">
        <!-- data from db -->
        <option value="<?=$fname?>"><?=$fname?></option>    
    </select>
    </div>
    <div class="mt-3"><input type="text" value="<?=$fare->economy_rate?>" class="form-control" name="economy_rate" id=""></div>
    
    <div class="mt-3"><input type="text" value="<?=$fare->business_rate?>" class="form-control" name="business_rate" id=""></div>
    <div class="text-center mt-3"><input type="submit" value="submit" class="btn btn-primary" name="submit"></div>
</form> 
</div>
<?php

    require '../../footer.php';
    
?>