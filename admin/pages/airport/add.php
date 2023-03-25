<?php
require '../../connection.php';
require '../../header.php';
 if(isset($_POST['name'])&&isset($_POST['abbr'])&&isset($_POST['state_id'])){
        $name=$_POST['name'];
        $abbr=$_POST['abbr'];
        $state_id=$_POST['state_id'];

        //checking whether the airport already exists
        $sql='SELECT * FROM airport WHERE name=:name AND abbr=:abbr AND state_id=:state';
        $sta=$connection->prepare($sql);
        $sta->execute([':name'=>$name,':abbr'=>$abbr,':state'=>$state_id]);
        $sql_fetch=$sta->fetch(PDO::FETCH_OBJ);
        if($sql_fetch)
        {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Airport already exists!',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='add.php';
              });

            </script>";   
        }
        else{
            $sql='INSERT INTO airport(name,abbr,state_id) VALUES(:name,:abbr,:state_id)';
            $statement=$connection->prepare($sql);
            if($statement->execute([':name'=>$name,':abbr'=>$abbr,':state_id'=>$state_id])){
                echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Successfully inserted',
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

    <div class="container-fluid row">
            <div class="col-md-3"></div>
        <div class="col-md-9 min-vh-100 mt-5">
                <form
                    action=""
                    method="POST" 
                    onsubmit=" return airport_validate() "
                    class="form-control p-3 w-75 mx-auto my-5 dark bg-opacity-25"
                    enctype="multipart/form-data"
                >
                    <div class="form-floating mb-2">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Name"
                            id="name"
                            name="name"
                        
                        />
                        <label for="name" class="form-label"
                            >Enter the Airport Name</label
                        >
                    </div>
                    <div class="form-floating mb-2">
                        <input
                            type="abbr"
                            class="form-control"
                            placeholder="Abbreviation"
                            id="abbr"
                            name="abbr"
                            
                        />
                        <label for="abbr" class="form-label"
                            >Abbreviation</label
                        >
                        
                    </div>
                    <div>
                        <?php 
                        $sql='SELECT * FROM state_list';
                        $statement=$connection->prepare($sql);
                        $statement->execute();
                        $names = $statement->fetchAll(PDO::FETCH_OBJ);
                        ?>

                    <select class="form-select mb-2" name="state_id" aria-label="Default select example" id="state_id">
                            <option value="">Select state</option>
                            <?php $i=1; foreach($names as $name): ?>
                            <option value=""><?= $name->name ?></option>
                            <?php $i=$i+1; 
                             endforeach; ?>
                    </select>
                    </div>
                    <div class="text-center">
                        <input
                            type="submit"
                            value="submit"
                            class="bg-primary px-4 py-2 rounded-2 text-light border-0"
                        />
                    </div>
                </form>
            </div>
        </div>
    </div>
            <?php
        require '../../footer.php';
    ?>