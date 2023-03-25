<?php
    require '../../connection.php';
    require '../../header.php';
    $sql='SELECT * FROM fare';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $fare=$statement->fetchAll(PDO::FETCH_OBJ);
?> 
    <div class="container-fluid">
        <div class="row">
        <div class="col-12 col-sm-8 mx-auto mt-5 p-5 overflow-scroll overflow-x-hidden" style="height:300px">
    <table class="table table-primary table-striped text-center">
        <thead>
            <tr>
                <th>
                    SlNo
                </th>
                <th>
                    Flight Name
                </th>
                <th>
                    Economy_Rate 
                </th>
                <th>
                    Business_Rate
                </th>
                <th colspan="2">Action</th>
                
        </thead>
        <tbody>
            <?php
            $i=1;
             foreach($fare as $rate):
                $flyid=$rate->fly_id;
                $sql='SELECT * FROM fly WHERE id=:id';
                $sta=$connection->prepare($sql);
                $sta->execute([':id'=>$flyid]);
                $fly=$sta->fetch(PDO::FETCH_OBJ);
                $flightid=$fly->flight_id;
                

                $q='SELECT * FROM flight WHERE id=:id';
                $s=$connection->prepare($q);
                $s->execute([':id'=>$flightid]);
                $flights=$s->fetch(PDO::FETCH_OBJ);
                $fname=$flights->name;
                 ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $fname ?></td>
                    <td><?= $rate->economy_rate ?></td>
                    <td><?= $rate->business_rate ?></td>
                
            
            <td ><a href="fare_edit.php?id=<?php echo $rate->id; ?>" class="btn btn-success" target="_self">Edit</a></td>
                    <?php if(isset($_GET['msg'])){
                         echo "<script>alert('updated Successfully')</script>";}?>
                    <td><a href="fare_delete.php?"class="btn btn-danger"onclick="return confirm('Are you sure?');">Delete</a>
                    <?php if(isset($_GET['del'])){
                         echo "<script>alert('Deleted Successfully')</script>";}?>
                </td>
                </tr>
            <tr>
            
            <?php
            $i=$i+1;
             endforeach; ?>
        </tbody>
    </table>
</div> 
        </div>
    </div>
<?php
require '../../footer.php';
?> 
