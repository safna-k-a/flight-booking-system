<?php   
session_start();
require 'connection.php';?>
<!DOCTYPE html>
<html>
  <head>
    <title>Seat FlyHigh.com</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="3c-reservation.css">
  </head>
  <body>
    <?php
    // (A) FIXED IDS FOR THIS DEMO
    $sessid = 1;
    $userid = $_SESSION['user_id'];
     //checking for payment status confirmed seats
    // If its not confirmed set seat unselected 
    // $sql="SELECT * FROM booking WHERE status=0";
    // $stmt=$connection->prepare($sql);
    // $stmt -> execute();
    // $not = $stmt->fetchAll(PDO :: FETCH_OBJ); //Not payment confirmed
    // foreach($not as $n){
    //   $f=$n->fly_id;
    //   $sql="UPDATE seat SET status=0,user_id=0 WHERE fly_id=:fly_id";
    //   $stmt=$connection->prepare($sql);
    //   $stmt -> execute([':fly_id'=>$f]);
    // }


    // (B) GET SESSION SEATS
    $sql= 'SELECT * FROM seat';
    $stmt = $connection->prepare($sql);
    $stmt -> execute();
    $seats = $stmt->fetchAll(PDO :: FETCH_OBJ);
    // require "2-reserve-lib.php";
    if(isset($_POST['userid'])){
      $s=$_POST['seats'];
      $u_id=$_SESSION['user_id'];
      $fly_id=$_SESSION['fly_id'];
      $sts=1;
      $count=count($s);
      $name=$_SESSION['name'];
      $n=count($name);                         //receive value
      // $id1=$_POST['seats[]'];
      // print_r($s);
      // echo $s[0];
      if($n<$count){
        echo"<script>alert('Lower seat number')</script>";   //check selected seat is greater than count
      }
      elseif($n==$count){
        //  echo $u_id;
         echo $fly_id;
        $sql="INSERT INTO booking (register_id, fly_id) VALUES (:u_id,:fly_id)";
        $stmt=$connection->prepare($sql);
        $stmt->execute(['u_id'=>$u_id,'fly_id'=>$fly_id]);  //inserting to book table
        $sql="SELECT * from booking WHERE register_id=:u_id AND fly_id=:fly_id";
        $stmt=$connection->prepare($sql);
        $stmt->execute(['u_id'=>$u_id,'fly_id'=>$fly_id]);
        $b = $stmt->fetch(PDO::FETCH_ASSOC);
        $b_id=$b['id'];                 //fetching booking id from booking table
        // echo $b_id;
        $c=0;
        $tot=0;
        $amt=array();
        $seat_no=array();
        echo "Else if".$b_id;
        if($b_id!=0){
            for ($x = 0; $x<$n; $x++) {
              $sn=$s[$x];
              $sql="UPDATE seat SET user_id =:u_id, status=:sts WHERE fly_id =:fly_id AND seat_no=:sn";   //updating seat status to booked
              $stmt = $connection->prepare($sql);
              if($stmt -> execute(['u_id'=> $u_id,'sts'=>$sts,'fly_id'=>$fly_id,'sn'=>$sn])){
                $sql="SELECT * from seat WHERE fly_id=:fly_id AND seat_no=:sn";
                $stmt=$connection->prepare($sql);
                $stmt->execute(['fly_id'=>$fly_id,'sn'=>$sn]);
                $am = $stmt->fetch(PDO::FETCH_OBJ);             //fetching amount
                $amt[$x]=$am->rate;                             //amount array
                $seat_no[$x]=$am->seat_no;                      //Seat number 
                $tot=$tot+$amt[$x];                               //Total calculate
                $sql="INSERT INTO passenger (name, booking_id, seat_no) VALUES (:name,:b_id,:sno)";   //inserting to passenger table
                $stmt = $connection->prepare($sql);
                if($stmt -> execute(['name'=> $name[$x],'b_id'=>$b_id,'sno'=>$sn])){
                    $c++;
                }
              }
              else{
                echo "Passenger table error";
              }
            }
            $_SESSION['amt']=$amt;
            $_SESSION['tot']=$tot;
            $_SESSION['seat_no']=$seat_no;
            $_SESSION['name']=$name;
            $_SESSION['u_id']=$u_id;
            $_SESSION['b_id']=$b_id;
            // header("Location:payment/pay.php");
            
        }
          echo "<script>window.location.href='payment/pay.php'</script>";
           
      }
        else{
               echo "<script>alert('select minimum seat')</script>";
           }
           
        
    }
      
      

  

    


    ?>
    <h1>flyHigh.COM</h1>
    <!-- (C) DRAW SEATS LAYOUT -->
    <div class="main">
      <div id="legend">
        <div class="seat h"></div> <div class="txt h">Open</div>
        <div class="seat  h taken"></div> <div class="txt h">Taken</div>
        <div class="seat h selected"></div> <div class="txt h">Selected</div>
      </div>
        <div id="layout" class="t-div"><?php
        foreach ($seats as $s) {
          $x=$s->status;
          if($x==0){
            $taken ='';
          }
          else{
            $taken="X";
          }
          
          printf("<div class='seat %s'%s>%s</div>",
            $taken ? " taken" : "",
            $taken ? "" : "onclick='reserve.toggle(this)'",
            $s->seat_no
          );
        }
        ?></div>
      <div id="legend">
        <div><p>A-C</p></div><div><p>Business Class</p></div>
        <div><p>D-J</p></div><div><p>Economy Class</p></div>
      </div>
    </div>

    <!-- (D) LEGEND -->
    <div  class="t-div-1">
      
      <div class="price-dis">
        <p>Window seats are expensive than middle seats</p>
      </div>
     
    </div>

    <!-- (E) SAVE SELECTION -->
   <div class="t-div-1">
   <form id="ninja" method="post" action="">
      <input type="hidden" name="sessid" value="<?=$sessid?>">
      <input type="hidden" name="userid" value="<?=$userid?>">
    </form>
   </div>
    <div class="btn">
      <button id="go" onclick="reserve.save()">Reserve Seats</button>
    </div>
    <script src="3b-reservation.js"></script>
  </body>
</html>