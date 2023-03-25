<?php
    require "connection.php";  
    require "header.php";
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        if(isset($_POST['pass'])&&isset(($_POST['cpass']))){
            $pass=$_POST['pass'];
            $cpass=$_POST['cpass'];
            if($pass!=$cpass){
                echo"Password not same";
            }
            else{
                $pass=md5($cpass);
                $sql='UPDATE register SET password=:pass WHERE token=:token';
                $statement=$connection->prepare($sql);
                if($statement->execute(['pass'=>$pass,'token'=>$token])){
                    echo "<script>Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Password Changed',
                        showConfirmButton: false,
                        timer: 1500
                      }).then(function(){
                            window.location='index.php';
                      });
                      </script>";
                }
                else{
                    echo"<script>Swal.fire({
                        icon: 'error',
                        title: 'Unsuccessfull',
                        text: 'Failed!',
                      })</script>";
                }
            }
    
        }
    }
    else{
        echo "Token not found";
    }
?>

<div class="">
                <form
                    action=""
                    method="POST"
                    class="form-control rounded-3 p-5 width mx-auto my-5"
                >
                    <div class="form-floating mb-1">
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Enter Password"
                            id=""
                            name="pass"
                            required
                        />
                        <label for="pass" class="form-label">Enter Password</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input
                            type="password"
                            class="form-control"
                            placeholder="Re-enter Password"
                            id=""
                            name="cpass"
                            required
                        />
                        <label for="cpass" class="form-label">Re-enter Password</label>
                    </div>
                    
                    <div class="text-center mt-2">
                        <input
                            type="submit"
                            value="submit"
                            class="bg-primary px-4 py-2 rounded-2 text-light border-0"
                            name="submit"
                        />
                    </div>
                </form>
</div>


<?php
    require "footer.php";
?>