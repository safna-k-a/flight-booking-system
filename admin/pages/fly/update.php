<?php
    require '../../connection.php';
    require '../../header.php';

    $sql='SELECT * FROM fly';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $routes=$statement->fetchAll(PDO::FETCH_OBJ);

?> 
<div class="container-fluid mt-5 mb-5 row">
    <div class="col-md-2"></div>
<div class="col-10 mt-5 p-5 table-responsive min-vh-100" style="height:470px overflow-x:auto;">
    <table class="table table-primary table-striped">
        <thead>
            <tr>
                <th>
                    SlNo
                </th>
                <th>
                    Flight Name
                </th>
                <th>
                    Departure
                </th>
                <th>
                    Arrival
                </th>
                <th>
                    Departure Date
                </th>
                <th>
                    Arrival Date
                </th>
                <th>
                    Departure Time
                </th>
                <th>
                    Arrival Time
                </th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
             foreach($routes as $route): ?>
                <tr>
                    <td><?= $i ?></td>
                    <?php
                        $flightid=$route->flight_id;
                        $sql='SELECT name FROM flight WHERE id=:id';
                        $sta=$connection->prepare($sql);
                        $sta->execute([':id'=>$flightid]);
                        $flightname=$sta->fetch(PDO::FETCH_OBJ);
                    ?>
                    <td><?=$flightname->name?></td>
                    <?php
                        $depid=$route->depart_id;
                        $sql='SELECT name FROM airport WHERE id=:id';
                        $sta=$connection->prepare($sql);
                        $sta->execute([':id'=>$depid]);
                        $depname=$sta->fetch(PDO::FETCH_OBJ);
                    ?>
                    <td><?=$depname->name?></td>
                    <?php
                        $arrid=$route->arrival_id;
                        $sql='SELECT name FROM airport WHERE id=:id';
                        $sta=$connection->prepare($sql);
                        $sta->execute([':id'=>$arrid]);
                        $arrname=$sta->fetch(PDO::FETCH_OBJ);
                    ?>
                    <td><?=$arrname->name?></td>
                    <td><?=$route->depart_date?></td>
                    <td><?=$route->arr_date?></td>
                    <td><?=$route->depart_time?></td>
                    <td><?=$route->arr_time?></td>
                    <td ><a href="edit.php?id=<?=$route->id;?>" class="btn btn-success" target="_blank">Edit</a></td>
                    <?php if(isset($_GET['msg'])){
                         echo "<script>alert('updated Successfully')</script>";}?>
                    <td><a href="delete.php?id=<?=$route->id;?>"class="btn btn-danger"onclick="return confirm('Are you sure?');">Delete</a>
                    <?php if(isset($_GET['del'])){
                         echo "<script>alert('Deleted Successfully')</script>";}?>
                 <?php
                    $i=$i+1;
                    endforeach; ?>
                    
             </tr> 
        </tbody>
    </table>
</div> 
</div>
<?php

    require '../../footer.php';
?>