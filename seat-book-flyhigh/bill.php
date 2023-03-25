<?php
    $db = new PDO("mysql:host=localhost;dbname=afrs", "root", "");
    session_start();
    $amt=$_SESSION['amt'];
    $tot=$_SESSION['tot'];
    $seat_no=$_SESSION['seat_no'];
    $name=$_SESSION['name'];
    $n=count($name);
    // print_r($seat_no);
    // print_r($amt);
    // echo $tot;
?>
<table>
  <thead>
    <tr>
        <th>Number</th>
        <th>Name</th>
        <th>Seat No</th>
        <th>Price</th>
    </tr>  
  </thead>
  <tbody>
    <?php for($i=0;$i<$n;$i++){ ?>
    <tr>
        <td><?=$i+1;?></td>
        <td><?=$name[$i];?></td>
        <td><?=$seat_no[$i];?></td>
        <td><?=$amt[$i];?></td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="3">Total</td>
        <td><?=$tot;?></td>
    </tr>
  </tbody>
</table>
<a href="payment/pay.php">Payment</a>