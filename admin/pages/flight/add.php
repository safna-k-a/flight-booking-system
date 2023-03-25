<?php
require '../../connection.php';
require '../../header.php';
 if(isset($_POST['name'])&&isset($_POST['airline_id'])&&isset($_POST['total_seat'])){
        $name=$_POST['name'];
        $airline_id=$_POST['airline_id'];
        $total_seat=($_POST['total_seat']);
        $created_by='admin';
     
        $sq='SELECT * FROM flight WHERE name=:name AND airline_id=:air';
        $sta=$connection->prepare($sq);
        $sta->execute([':name'=>$name,':air'=>$airline_id]);
        $sq_fetch=$sta->fetch(PDO::FETCH_OBJ);
        if($sq_fetch)
        {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Flight already exists!',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='flights.php';
              });

            </script>";  
        }
        else
        {
            $sql='INSERT INTO flight(name,airline_id,total_seat,created_by) VALUES(:name,:airline_id,:total_seat,:cby)';
            $statement=$connection->prepare($sql);
            if($statement->execute([':name'=>$name,':airline_id'=>$airline_id,':total_seat'=>$total_seat,
            ':cby'=>$created_by])){
                echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Successfully Inserted',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='add.php';
              });

            </script>";
                
        }
        }
            
    
 }
 

?>

    <div class="mt-5 min-vh-100">
                <form 
                    action="" 
                    method="POST"
                    onsubmit="return flight_validate()"
                    class="form-control p-5 w-50  mx-auto my-5 dark bg-opacity-75"
                    enctype="multipart/form-data" 
                >
                    <div class="form-floating mb-1">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Name"
                            id="name"
                            name="name"
                         
                        />
                        <label for="name" class="form-label">Enter flight name</label>
                    </div>
                    
                    <div class="form-floating mb-1">
                    <?php 
                        $sql='SELECT * FROM airline';
                        $statement=$connection->prepare($sql);
                        $statement->execute();
                        $airlines=$statement->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    
                    <select class="form-select" name="airline_id" id="airline_id" aria-label="Default select example">
                            <option>choose Airline</option>
                            <?php $i=1; foreach($airlines as $airline): ?>
                            <option value="<?=$airline->id;?>"><?= $airline->name ?></option>
                            <?php $i=$i+1; 
                             endforeach; ?>
                    </select>   
                    </div>
                    <div class="form-floating mb-1">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="total_seat"
                            id="total_seat"
                            name="total_seat"
                            
                        />
                        <label for="total_seat" class="form-label"
                            >Total seat</label
                        >
                    </div>
                    <div class="text-center">
                        <input
                            type="submit"
                            value="submit"
                            id="submit"
                            class="bg-primary px-4 py-3 rounded-2 text-light border-0"
                        />
                    </div>
                </form>
            </div>
            <?php
        require '../../footer.php';
    ?>