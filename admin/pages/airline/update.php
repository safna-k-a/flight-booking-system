<?php
    require '../../connection.php';
    require '../../header.php';
    $sql='SELECT * FROM airline';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $airlines=$statement->fetchAll(PDO::FETCH_OBJ);

?> 
<div class="container-fluid">
<div class="row min-vh-100">
    <div class="col-md-4"></div>
<div class="mt-md-5 col-7 mt-2 p-5 " style="height:470px">
    <table class="table table-primary table-striped text-center">
        <thead>
            <tr>
                <th>
                    SlNo
                </th>
                <th>
                    Airline
                </th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
             foreach($airlines as $airline): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $airline->name ?></td>
                    <td ><a href="edit.php?id=<?=$airline->id; ?>" class="btn btn-success"  target="_self">Edit</a></td>
                    <?php if(isset($_GET['msg'])){
                         echo "<script>alert('updated Successfully')</script>";}?>
                    <td><a href="delete.php?id=<?=$airline->id;?>"class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
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
<?php

    require '../../footer.php';
?>