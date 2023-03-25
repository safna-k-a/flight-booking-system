<?php
session_start();
    require '../connection.php';
    $email=$_SESSION['email'];
    $sql='SELECT * from register WHERE email=:email LIMIT 1';
    $statement=$connection->prepare($sql);
    $statement->execute([':email'=>$email]);
    $user=$statement->fetch(PDO::FETCH_OBJ);
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql='SELECT * from fly WHERE id=:id LIMIT 1';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$id]);
    $fly=$statement->fetch(PDO::FETCH_OBJ);
    $dep=$fly->depart_id;
    $arr=$fly->arrival_id;
    $sql='SELECT * from airport WHERE id=:id LIMIT 1';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$dep]);
    $depart=$statement->fetch(PDO::FETCH_OBJ);
    $sql='SELECT * from airport WHERE id=:id LIMIT 1';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$arr]);
    $arrival=$statement->fetch(PDO::FETCH_OBJ);

    $sql='SELECT * from fare WHERE fly_id=:id LIMIT 1';
    $statement=$connection->prepare($sql);
    $statement->execute([':id'=>$fly->id]);
    $fare=$statement->fetch(PDO::FETCH_OBJ);
    $_SESSION['user_id']=$user->id;
    $_SESSION['fly_id']=$fly->id;
     if(isset($_POST['submit'])){
        $p1=$_POST['passenger1'];
        $p2=$_POST['passenger2'];
        $p3=$_POST['passenger3'];
        $p=array($p1,$p2,$p3);
        $j=0;
        $name=array();
        for($i=0;$i<3;$i++){
            if($p[$i]!=''){
               $name[$j]=$p[$i];
               $j++;
            }
        }
        $_SESSION['name']=$name;
        echo "<script>window.location.href='../../seat-book-flyhigh/3a-reservation.php'</script>";
        
    }

}?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>FLYHIGH.COM </title>
        <link rel="icon" type="image/x-icon" href="./images/favicon.png" />
        <!-- css bootstrap -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css
        "
        />
        <link rel="stylesheet" href="../css/style.css" />
    </head>
    <body>
        <div class="container-fluid row m-0 p-0">
            <div
                class="container col-md-9 bg-light mt-5 rounded-4 border justify-content-center align-items-center"
            >
                <h3 class="fw-bolder mt-3">
                    PASSENGER COUNT: <span id="passengerCount">1</span>

                    <button class="w1 fs-3" id="plus" onclick="addPassenger()">
                        +
                    </button>
                    <button
                        class="w2 fs-3"
                        id="minus"
                        onclick="subtractpassenger()"
                    >
                        −
                    </button>
                </h3>
                <form method="POST" action="">
                    <div class="row justify-content-center p-5">
                        <div class="border rounded-3 p-3">
                            <div class="row text-center">
                            <div class="row mb-4">
                                <div class="col-md-5 m-0">
                                    <label class="fs-4 fw-bold" for=""
                                        >PASSENGER 1</label
                                    >
                                </div>
                                <div class="col-md-5 m-0">
                                    <input
                                        type="text"
                                        name="passenger1"
                                        id=""
                                        placeholder="NAME"
                                        class="form-control mt-2"
                                    />
                                </div>
                               
                            </div>

                            <div class="row mb-4" id="passenger2">
                                <div class="col-md-5 m-0">
                                    <label class="fs-4 fw-bold" for=""
                                        >PASSENGER 2</label
                                    >
                                </div>
                                <div class="col-md-5 m-0">
                                    <input
                                        type="text"
                                        name="passenger2"
                                        id=""
                                        placeholder="NAME"
                                        class="form-control mt-2"
                                    />
                                </div>
                                
                            </div>
                            <div class="row mb-4" id="passenger3">
                                <div class="col-md-5 m-0">
                                    <label class="fs-4 fw-bold" for=""
                                        >PASSENGER 3</label
                                    >
                                </div>
                                    <div class="col-md-5 m-0">
                                    <input
                                        type="text"
                                        name="passenger3"
                                        id=""
                                        placeholder="NAME"
                                        class="form-control mt-2"
                                    />
                                </div>
                               
                            </div>
                            </div>
                            <div class="row mb-4 mt-5">
                                <div class="col-5 col-sm-5 text-md-start">
                                    <!--  place From   -->
                                    <h5 class="fw-bolder">From</h5>
                                    <p class="mb-0 text-grey"><?=$depart->name?></p>
                                </div>

                                <div class="col-2 text-center">
                                    <i class="fa-solid fa-plane"></i>
                                </div>

                                <div class="col-5 col-sm-5 text-md-end">
                                    <!--  place From   -->
                                    <h5 class="fw-bolder">To</h5>
                                    <p class="mb-0 text-grey"><?=$arrival->name?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                
                                    <h5 class="fw-bold">Date : <?=$fly->depart_date?></h5>
                                    <h5 class="fw-bold">Time : <?=$fly->depart_time?></h5>
                                </div>
                            
                                <div class="col-6 text-md-end">
                    
                                    <h5 class="fw-bold">Date : <?=$fly->arr_date?></h5>
                                    <h5 class="fw-bold">Time : <?=$fly->arr_time?></h5>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                    <div class="row m-0 p-0">
                        
                        <div class="col-5 mt-3">
                            <input type="submit" name="submit" value="Select Your Seat"
                                class="btn btn-success text-light fw-bolder"
                                >
                            
                        </div>
                        <div class="col-5 mt-3">
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--jquery cdn-->
        <script
            src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous"
        ></script>
        <!-- <script>
            $(document).ready(() => {
                $count=document.getElementById("passengerCount").innerHTML;
               $('#passengerCount').onchange(()=>{
                    let add=$('#passengerCount').val()
                    $.ajax({
                        url:'live_search.php',
                        method:'POST',
                        data:{count:add},
                        success:function(data){
                            if(data!=0){
                                
                            }
                        }});
               });
            });
        </script> -->
        <!-- fontawesome -->
        <script
            src="https://kit.fontawesome.com/4ebb318577.js"
            crossorigin="anonymous"
        ></script>
        <!-- js bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js
         "></script>
        <!-- js -->
        <script src="../../js/script.js"></script>
    </body>
</html>
