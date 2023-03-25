<?php
    require '../../connection.php';
    require '../../header.php';

    $sql='SELECT * FROM fly';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $routes=$statement->fetchAll(PDO::FETCH_OBJ);

?> 
<div class="container-fluid row">
    <div class="col-md-2"></div>
<div class=" col-md-10 col-12 mt-5 p-3 table-responsive min-vh-100" style="height:470px">
    <table class="table table-primary table-striped style="overflow-x: auto;">
        <thead class="sticky">
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