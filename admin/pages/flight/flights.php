<?php
    require '../../connection.php';
    require '../../header.php';
    $sql='SELECT * FROM flight';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $flights=$statement->fetchAll(PDO::FETCH_OBJ);

?> 
<div class=" container row justify-content-center">
    <div class="col-md-3"></div>
    <div class="col-12 col-md-7  p-5 table-responsive min-vh-100" style="height:300px ">
    <table class="table table-primary table-striped text-center">
        <thead >
            <tr>
                <th>
                    SlNo
                </th>
                <th>
                    Name
                </th>
                <th>
                    Airline 
                </th>
                <th>
                    total Seats
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
             foreach($flights as $flight): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $flight->name ?></td>
                    <td><?= $flight->airline_id ?></td>
                    <td><?= $flight->total_seat ?></td>
                </tr>
            <tr>
            
            <?php
            $i=$i+1;
             endforeach ?>
        </tbody>
    </table>
</div> 
    </div>
</div>
<?php

    require '../../footer.php';
?>
