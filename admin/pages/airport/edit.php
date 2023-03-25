<?php
    require '../../connection.php';
?> 
<?php
    require '../../header.php';
    $id=$_GET['id'];
    $sql='SELECT * FROM airport WHERE id=:id';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$id]);
    $airport=$statement->fetch(PDO::FETCH_OBJ);
    $stid=$airport->state_id;

        // selecting name from states table with corresponding id while displaying the details
    $sql='SELECT * FROM state_list WHERE id=:id';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$stid]);
    $state_name=$statement->fetch(PDO::FETCH_OBJ);
    $sname=$state_name->name;

    // for displaying states in form
    $sql='SELECT * FROM state_list';
    $sta=$connection->prepare($sql);
    $sta->execute();
    $states=$sta->fetchAll(PDO::FETCH_OBJ);


    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $abbr=$_POST['abbreviation'];
        $state=$_POST['state'];
        $updated_by='admin';

        // Replacing name with id while updating the details
        $sql='SELECT * FROM state_list WHERE name=:name';
        $statement=$connection->prepare($sql);
        $statement->execute([':name'=>$state]);
        $states=$statement->fetch(PDO::FETCH_OBJ);
        $stateid=$states->id;

        $sql='SELECT * FROM airport WHERE name=:name AND abbr=:abbr AND state_id=:state';
        $sta=$connection->prepare($sql);
        $sta->execute([':name'=>$name,':abbr'=>$abbr,':state'=>$stateid]);
        $sql_fetch=$sta->fetch(PDO::FETCH_OBJ);
        if($sql_fetch)
        {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Airport already exists!',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='add.php';
              });

            </script>";   
        }
        else{
            $sql='UPDATE airport set name=:name,abbr=:abbr,state_id=:state,updated_by=:updated_by WHERE id=:id';
            $statement=$connection->prepare($sql);
            $success=$statement->execute([':name'=>$name,':abbr'=>$abbr,':state'=>$stateid,':updated_by'=>$updated_by,':id'=>$id]);
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
                window.location='update.php';
              });

            </script>";
            }
        }
        
    }
?>
<div class="container row justify-content-center min-vh-100">
<div class="col-md-3"></div>
<div class=" col-md-5 col-10  mt-5 ms-5 dark bg-opacity-25 p-5 ">
<form action="" method="POST" onsubmit="return validate()" class="">
    <div class="mt-3"><input type="text" value="<?=$airport->name?>" class="form-control" name="name" id=""></div>
    
    <div class="mt-3"><input type="text" value="<?=$airport->abbr?>" class="form-control" name="abbreviation" id=""></div>

    <!-- <div class="mt-3"><input type="select" value="<?=$sname?>" class="form-control" name="state" id=""></div> -->
    <div class="mt-3">
    <select name="state" id="" class="form-control">
    <option value="<?=$sname;?>"><?=$sname;?></option>
        <?php foreach($states as $s): ?>
            <option value="<?=$s->name;?>"><?=$s->name;?></option>
            <?php 
            endforeach; ?>

    </select>
    </div>

    <div class="text-center mt-3"><input type="submit" value="submit" class="btn btn-primary" name="submit"></div>
</form> 
</div>
<?php

    require '../../footer.php';
    
?>