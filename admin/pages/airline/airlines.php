<?php
    require '../../connection.php';
    require '../../header.php';
    $sql='SELECT * FROM airline';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $airlines=$statement->fetchAll(PDO::FETCH_OBJ);


?> 
<div class="container-fluid row justify-content-center">
    <div class="col-md-3"></div>
    <div class=" col-md-6 col-8 mt-5 p-5 min-vh-100" style="height:470px">
    <table class="table table-primary table-striped text-center w-100">
        <thead>
            <tr>
                <th>
                    SlNo
                </th>
                <th>
                    Airline
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
             foreach($airlines as $airline): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $airline->name ?></td>
                </tr>
            <tr>
            
            <?php
            $i=$i+1;
             endforeach ?>
        </tbody>
    </table>
</div> 
</div>
<?php

    require '../../footer.php';
?>