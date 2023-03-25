<?php
    require '../../connection.php';
    require '../../header.php';
    $sql='SELECT id,name,abbr,state_id FROM airport';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $airports=$statement->fetchAll(PDO::FETCH_OBJ);


?> 
<div class="container-fluid mt-5">
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-10  row min-vh-100">
    <div class="table-responsive mt-5 p-5" style="height:470px">
    <table class="table table-primary table-striped">
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
                <th colspan="2">Action</th>
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
                    <td ><a href="edit.php?id=<?=$airport->id; ?>" class="btn btn-success" target="_self">Edit</a></td>
                    <?php if(isset($_GET['msg'])){
                         echo "<script>alert('updated Successfully')</script>";}?>
                    <td><a href="delete.php?id=<?=$airport->id;?>"class="btn btn-danger"onclick="return confirm('Are you sure?');">Delete</a>
                    <?php if(isset($_GET['del'])){
                         echo "<script>alert('Deleted Successfully')</script>";}?>
                </td>
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
</div>
<?php

    require '../../footer.php';
?>