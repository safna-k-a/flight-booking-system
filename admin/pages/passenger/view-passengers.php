<?php require '../connection.php';
       require 'export.php'  ?>
<?php require '../header.php' ?>


<!-- <title>phpzag.com : Demo Export Data to Excel with PHP and MySQL</title> -->

<div class="container">
    <h2>Export Data to Excel with PHP and MySQL</h2>
    <div class="well-sm col-sm-12 row text-end">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
            <div class="btn-group pull-right">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <button type="submit" id="export_data" name='export' value="Export to excel"
                        class="btn btn-danger mb-2 ">Download</button>
                </form>
            </div>
        </div>
    </div>
    <table id="" class="table table-borderless">
        <tr class="table-success">
            <th>Name</th>
            <th>Email</th>
            <th>Flight Name</th>
            <th>Arrival</th>
            <th>Departure</th>
        </tr>
        <tbody>
        
        <?php foreach ($data as $d):
                foreach ($data2 as $c): 
                    foreach($data4 as $f):
                        foreach($data5 as $a):
                            foreach($data6 as $b):?>
            <tr>
                <td><?php echo $d['name']; ?></td>
                <td><?php echo $c['email']; ?></td>
                <td><?php echo $f['name']; ?></td>
                <td><?php echo $a['name']; ?></td>
                <td><?php echo $b['name']; ?></td>
            </tr>
            <?php endforeach;
                    endforeach;
                    endforeach;
                    endforeach;
                    endforeach;
                    ?>
            
        </tbody>
    </table>


<?php require '../footer.php' ?>