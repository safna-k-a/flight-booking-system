<?php
    require '../../connection.php';
    require '../../header.php';
    $sql='SELECT id,name,abbr,state_id FROM airport';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $airports=$statement->fetchAll(PDO::FETCH_OBJ);


?> 
<div class="container-fluid row justify-content-center mt-5">
<div class="col-md-3 mt-5"></div>
<div class=" col-md-8 table-responsive mt-5  min-vh-100" style="height:470px">
    <table class="table table-primary table-striped\">
        <thead>
            <tr>
                <th>
                    SlNo
                </th>
                <th>
                    Airport
                </th>
                <th>
                    Abbreviation
                </th>
                <th>
                    State
                </th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
             foreach($airports as $airport): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $airport->name ?></td>
                    <td><?= $airport->abbr ?></td>
                    <?php
                            $sid=$airport->state_id;
                            $sql='SELECT name FROM state_list WHERE id=:id';
                            $statement=$connection->prepare($sql);
                            $statement->execute([':id'=>$sid]);
                            $state=$statement->fetch(PDO::FETCH_OBJ);
                            ?>
                    <td><?= $state->name;?></td>
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