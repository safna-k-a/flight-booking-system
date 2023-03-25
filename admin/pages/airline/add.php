<?php
require '../../connection.php';
require '../../header.php';
 if(isset($_POST['airline_name'])){
        $name=$_POST['airline_name'];
        $a='admin';

        $sql='SELECT * FROM airline WHERE name=:name LIMIT 1';
        $statement=$connection->prepare($sql);
        $statement->execute([':name'=>$name]);
        $c=$statement->fetch(PDO::FETCH_OBJ);
        if($c) {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Airline already exists!',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='add.php';
              });

            </script>";
        }
        else{

            $sql='INSERT INTO airline(name,created_by)VALUES(:name,:created_by)';
            $statement=$connection->prepare($sql);
            $s=$statement->execute([':name'=>$name,':created_by'=>$a]);
            if($s)
            {
                echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Airline Added',
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
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class=" col-10 mt-5 min-vh-100">
        <form
                    action=""
                    method="POST"
                    class="form-control p-5 w-75 mx-auto my-5 dark bg-opacity-50"
                    enctype="multipart/form-data"
                >
                    <div class="form-floating mb-3">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Airline Name"
                            id="name"
                            name="airline_name"
                            required
                        />
                        <label for="name" class="form-label">Airline Name</label>
                    </div>
                    
                    <div class="text-center">
                        <input
                            type="submit"
                            value="Add"
                            class="bg-primary px-3 py-2 rounded-2 text-light border-0"
                        />
                    </div>
                </form>  
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <?php
        require '../../footer.php';
    ?>
