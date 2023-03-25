<?php
    require '../../connection.php';
?> 
<?php
    require '../../header.php';
    //getting the id passed from update page
    $id=$_GET['id'];
    $sql='SELECT * FROM fly WHERE id=:id';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$id]);
    $routes=$statement->fetch(PDO::FETCH_OBJ);
    $flightid=$routes->flight_id;

        //choosing name from flight table
    $sql='SELECT name FROM flight WHERE id=:id';
    $sta=$connection->prepare($sql);
    $sta->execute([':id'=>$flightid]);
    $flightname=$sta->fetch(PDO::FETCH_OBJ);
    $name=$flightname->name;

        //choosing source airport name using departure id
        $depid=$routes->depart_id;
        $sql='SELECT name from airport WHERE id=:id';
        $sta=$connection->prepare($sql);
        $sta->execute([':id'=>$depid]);
        $depname=$sta->fetch(PDO::FETCH_OBJ);
        $departure=$depname->name;

        //choosing destination airport name using arrival id
        $arrid=$routes->arrival_id;
        $sql='SELECT name from airport WHERE id=:id';
        $sta=$connection->prepare($sql);
        $sta->execute([':id'=>$arrid]);
        $arrname=$sta->fetch(PDO::FETCH_OBJ);
        $arrival=$arrname->name;

        //for displaying airport names
        $sql='SELECT name from airport';
        $sta=$connection->prepare($sql);
        $sta->execute();
        $airs=$sta->fetchAll(PDO::FETCH_OBJ);
    
    $depdate=$routes->depart_date;
    $arrdate=$routes->arr_date;
    $deptime=$routes->depart_time;
    $arrtime=$routes->arr_time;

    if(isset($_POST['submit'])){
        $name=$_POST['flight_name'];
        $depart=$_POST['departure'];
        $ar=$_POST['arrival'];
        $ddate=$_POST['departure_date'];
        $adate=$_POST['arrival_date'];
        $dtime=$_POST['departure_time'];
        $atime=$_POST['arrival_time'];
        $up='admin';

        // Replacing name with id while updating the details
        $query='SELECT * FROM flight WHERE name=:name';
        $sta=$connection->prepare($query);
        $sta->execute([':name'=>$name]);
        $flaights=$sta->fetch(PDO::FETCH_OBJ);
        $fid=$flaights->id;

        $q='SELECT * FROM airport WHERE name=:name';
        $s=$connection->prepare($q);
        $s->execute([':name'=>$depart]);
        $airps=$s->fetch(PDO::FETCH_OBJ);
        $did=$airps->id;

        $qu='SELECT * FROM airport WHERE name=:name';
        $stat=$connection->prepare($qu);
        $stat->execute([':name'=>$ar]);
        $airp=$stat->fetch(PDO::FETCH_OBJ);
        $aid=$airp->id;

        //checking if value already exists
        $sql='SELECT * FROM fly WHERE flight_id=:f_id AND depart_id=:d_id AND depart_date=:d_date AND depart_time=:d_time';
        $sta=$connection->prepare($sql);
        $sta->execute([':f_id'=>$fid,':d_id'=>$did,':d_date'=>$ddate,':d_time'=>$dtime]);
        $q_check=$sta->fetch(PDO::FETCH_OBJ);
        if($q_check)
        {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Route already exists!',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='update.php';
              });

            </script>";    
        }
        else{
            $sql='UPDATE fly set flight_id=:fid,depart_id=:did,arrival_id=:aid,arr_date=:adate,depart_date=:ddate,arr_time=:atime,
            depart_time=:dtime,edited_by=:eby WHERE id=:id';
        $statement=$connection->prepare($sql);  
        $success=$statement->execute([':fid'=>$fid,':did'=>$did,':aid'=>$aid,':adate'=>$adate,':ddate'=>$ddate,
            ':atime'=>$atime,':dtime'=>$dtime,':eby'=>$up,':id'=>$id]);
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
        else
        {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Something Went Wrong!',
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
<div class="container row justify-content-center">
    <div class="col-md-3"></div>
<div class="col-md-8 col-10 form  mt-5 ms-5 dark bg-opacity-25 p-5 min-vh-100">
<form action="" method="POST" onsubmit="return validate()" class="">
<div class="mt-3">
    <select name="flight_name" id="flight_name" class="form-control">
    <option value="<?=$name;?>"><?=$name;?></option>
        <?php 
        $sql='SELECT name from flight';
        $sta=$connection->prepare($sql);
        $sta->execute();
        $flights=$sta->fetchAll(PDO::FETCH_OBJ);
        foreach($flights as $f): ?>
            <option value="<?=$f->name?>"><?=$f->name?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="mt-3">
    <select name="departure" id="departure" class="form-control">
    <option value="<?=$departure;?>"><?=$departure;?></option>
        <?php 
        foreach($airs as $as): ?>
            <option value="<?=$as->name?>"><?=$as->name?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="mt-3">
    <select name="arrival" id="arrival" class="form-control">
    <option value="<?=$arrival;?>"><?=$arrival;?></option>
        <?php 
        foreach($airs as $s): ?>
            <option value="<?=$s->name?>"><?=$s->name?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="mt-3"><input type="date" value="<?=$depdate?>" class="form-control" name="departure_date" id=""></div>
<div class="mt-3"><input type="date" value="<?=$arrdate?>" class="form-control" name="arrival_date" id=""></div>
<div class="mt-3"><input type="text" value="<?=$deptime?>" class="form-control" name="departure_time" id=""></div>
<div class="mt-3"><input type="text" value="<?=$arrtime?>" class="form-control" name="arrival_time" id=""></div>
<div class="text-center mt-3"><input type="submit" value="submit" class="btn btn-primary" name="submit"></div>
</form> 
</div>
</div>
<?php

    require '../../footer.php';
    
?>