<?php
    session_start();
    require 'connection.php';
    require 'header.php';
    if(isset($_SESSION['url']))
    {
        $x=$_SESSION['url'];
    }
   
?> 
<?php
    $val=false;
    if(isset($_POST['email'])&&isset($_POST['password'])){
        $email=$_POST['email'];
        $password=($_POST['password']);
        $_SESSION['email']=$email;
        $_SESSION['password']=$password;
        $sql='SELECT * from register where email=:email LIMIT 1';
        $statement=$connection->prepare($sql);
        $statement->execute([':email'=>$email]);
        $user=$statement->fetch(PDO::FETCH_OBJ);
        if($user){
            $var=$user->password;
            if(md5($password)==$var){
                $sql='SELECT * from user where id=:status LIMIT 1';
                $statement=$connection->prepare($sql);
                $statement->execute([':status'=>$user->status]);
                $user_type=$statement->fetch(PDO::FETCH_OBJ);
                $u=$user_type->user_type;
                if(isset($_SESSION['url'])&&$u=='user'){
                    $url=$_SESSION['url'];
                    // header( "Location: $x" );
                    echo "<script>window.location.href='$x';</script>";
                }
                elseif($u=='admin'){
                echo "<script>window.location.href='admin/index.php';</script>";
                }
                else{
                    // header('Location:user/index.php');
                    echo "<script>window.location.href='user/index.php';</script>";
                }
            }
            else{
                $val=true;
            }
           
            
        }
        else{
            $val=true;
        }
        
    
    }
    
       
    
?>

<div class="container b">
    <div class="row  justify-content-center align-items-center mt-5 m-0 p-0 pt-5">
       
        <div class="col-12 col-sm-7 row justify-content-center m-0 p-0">
            <div class="text-primary col-12 col-sm-3 text-center mb-5">
                 
        
            </div>
            <div class="col-12 col-sm-10">
                <form action="" method="POST" onsubmit="return log_validate()">
                    <?php
                if($val=="true"){
                echo'
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Incorrect Email or Password!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
                  ';}
                ?>
                    <div>
                        <input type="text" placeholder="Email"  class="form-control border border-primary p-2 mb-3" name="email" id="eml">
                    </div>
                    <div>
                        <input type="password" placeholder="Password" class="form-control border border-primary p-2 mb-3" name="password" id="pwd">
                    </div>
                    
                    
                    <div class="row mx-auto">
                        <div  class="col-sm-6">
                        <input type="submit" value="SIGN IN" class=" btn log-btn form-control mb-3">
                    </div>
                    
                    <div class="col-sm-6">
                        <a href="register.php" class="btn log-btn form-control mb-3">SIGN UP</a>
                    </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <a href="../forget-pass.php" class="text-light">Forgot Password?</a>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>












<!--<div class="main-div">-->
  
<!--                <form-->
<!--                    action=""-->
<!--                    method="POST"-->
<!--                    class="p-5 width mx-auto my-5"-->
<!--                >-->
<!--                    <div class="form-floating mb-1">-->
<!--                        <input-->
<!--                            type="email"-->
<!--                            class="form-control"-->
<!--                            placeholder="Enter Email"-->
<!--                            id="email"-->
<!--                            name="email"-->
<!--                            required-->
<!--                        />-->
<!--                        <label for="email" class="form-label">Email Id</label>-->
<!--                    </div>-->
<!--                    <div class="form-floating mb-1">-->
<!--                        <input-->
<!--                            type="password"-->
<!--                            class="form-control"-->
<!--                            placeholder="Enter Password"-->
<!--                            id="password"-->
<!--                            name="password"-->
<!--                            required-->
<!--                        />-->
<!--                        <label for="password" class="form-label">Enter Password</label>-->
<!--                    </div>-->
                    
<!--                    <div class="text-center mt-2">-->
<!--                        <input-->
<!--                            type="submit"-->
<!--                            value="submit"-->
<!--                            class="bg-primary px-4 py-2 rounded-2 text-light border-0"-->
<!--                        />-->
<!--                        <a href="register.php" type="button" class="text-decoration-none bg-primary px-4 py-2 rounded-2 text-light border-0">Sign Up</a>-->
<!--                    </div>-->
                    
<!--                    <a href="forget-pass.php">Forgot Password.?</a>-->
<!--                </form>-->
<!--</div>-->
            <!-- login  -->
    <?php
        require 'footer.php';
    ?>