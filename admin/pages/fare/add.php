<?php
require '../../connection.php';
require '../../header.php';
 if(isset($_POST['fly_id'])&&isset($_POST['economy_rate'])&&isset($_POST['business_rate'])){
        $fly_id=$_POST['fly_id'];
        $economy_rate=$_POST['economy_rate'];
        $business_rate=($_POST['business_rate']);
     
            $sql='INSERT INTO fare(fly_id,economy_rate,business_rate) VALUES(:fly_id,:economy_rate,:business_rate)';
            $statement=$connection->prepare($sql);
            if($statement->execute([':fly_id'=>$fly_id,':economy_rate'=>$economy_rate,':business_rate'=>$business_rate])){
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
 

?>

    <div class="container-fluid  row justify-content-center">
        <div class=" col-md-3"></div>
            <div class="mt-5 col-md-5 col-10 min-vh-100 ">
                <form 
                    action="" onsubmit="return fare_validate()"
                    method="POST" 
                    class="form-control p-5  my-5 dark bg-opacity-25"
                    enctype="multipart/form-data" 
                >
                    
                    <div>
                    <?php 
                        $sql='SELECT * FROM flight';
                        $statement=$connection->prepare($sql);
                        $statement->execute();
                        $flys=$statement->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    
                    <select class="form-control mb-3" name="fly_id" id="fly_id" aria-label="Default select example">
                            <option value="">Select flight</option>
                            <?php $i=1; foreach($flys as $fly): ?>
                            <option value="<?=$fly->id;?>"><?= $fly->name ?></option>
                            <?php $i=$i+1; 
                             endforeach; ?>
                    </select>   
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="economy_rate"
                            id="economy_rate"
                            name="economy_rate"
                            
                        />
                        <label for="total_seat" class="form-label"
                            >Economy rate</label
                        >
                    </div>
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="business_rate"
                            id="business_rate"
                            name="business_rate"
                         
                        />
                        <label for="name" >Business rate</label>
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
    </div>
            <?php
        require '../../footer.php';
    ?>
