<?php
require 'connection.php';
require 'header.php';
 if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['phone'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $c_password=md5($_POST['c_password']);
        $phone_number=$_POST['phone'];
        if($password!=$c_password){
            $pass=true;

        }
        else{
        $pic=$_FILES['photo']['name']; 
        $temp=$_FILES['photo']['tmp_name'];
        $target="uploads/".basename($pic);
        $move_pic=move_uploaded_file($temp,$target);
        $sql=("SELECT * FROM register WHERE email=:email AND phone=:phone LIMIT 1");
        $statement=$connection->prepare($sql);
        $statement->execute([':email' => $email,':phone'=>$phone_number]);
        $check_email=$statement->fetch(PDO::FETCH_ASSOC);
        if ($check_email) {
            $val=true;
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'User Already exists!',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='login.php';
              });

            </script>";
        }
        else{
        
            $sql='INSERT INTO register(name,email,password,phone,photo,status) VALUES(:name,:email,:password,:phone,:photo,:status)';
            $statement=$connection->prepare($sql);
            if($statement->execute([':name'=>$name,':email'=>$email,':password'=>$password,':phone'=>$phone_number,':photo'=>$pic,':status'=>'2'])){
                echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Registered Successfully',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='login.php';
              });

            </script>";
                }
        }
    }
 }
 

?>

    <div class="">
                <form 
                    action="" onsubmit="return validate()" 
                    method="POST"
                    class="p-5 w-50 mx-auto my-5"
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
                        <label for="name" class="form-label">Full Name</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Email"
                            id="email"
                            name="email"
                            
                        />
                        <label for="email" class="form-label"
                            >Enter Email</label
                        >
                    </div>
                    <div class="form-floating mb-1">
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Password"
                            id="password"
                            name="password"
                            
                        />
                        <label for="password" class="form-label"
                            >Enter Password</label
                        >
                    </div>
                    <div class="form-floating mb-1">
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Confirm Password"
                            id="c_password"
                            name="c_password"
                            
                        />
                        <label for="c_password" class="form-label"
                            >Re-enter Password</label
                        >
                    </div>
                    <div class="form-floating mb-1">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Phone "
                            id="phone"
                            name="phone"
                           
                        />
                        <label for="phone" class="form-label"
                            >Enter Phone number</label
                        >
                    </div>
                    <div class="form-floating mb-1">
                        <input
                            type="file"
                            class="form-control"
                            placeholder=""
                            id="photo"
                            name="photo"
                            
                        />
                        
                    </div>
                    <div class="text-center">
                        <input
                            type="submit"
                            value="submit"
                            id="submit"
                            class="bg-primary px-4 py-2 rounded-2 text-light border-0"
                        />
                    </div>
                </form>
            </div>
            <?php
        require 'footer.php';
    ?>