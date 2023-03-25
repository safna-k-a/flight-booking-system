<?php 
    session_start();
    require('razorpay-php/Razorpay.php'); 
    require_once("config.php");
    $u_id=$_SESSION['u_id'];
    $amt=$_SESSION['amt'];
    $tot=$_SESSION['tot'];
    $seat_no=$_SESSION['seat_no'];
    $name=$_SESSION['name'];
      if($u_id='') 
      {
      	 //header('location:index.php');
      	 echo "<script>alert('Please login')</script>";
      	 echo "<script>window.location.href='../../login.php'</script>";
      }
      else 
      {
        $pid=111111;
      }
      ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment - FlyHigh.com </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" a href="css/style.css" />
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-12 form-container">
				<h1>Payment</h1>
<hr>
<?php 
include("gateway-config.php");
//Razorpay//
use Razorpay\Api\Api;
// $db = new PDO("mysql:host=localhost;dbname=afrs", "root", "");

$amt=$_SESSION['amt'];
$tot=$_SESSION['tot'];
$seat_no=$_SESSION['seat_no'];
$name=$_SESSION['name'];
$n=count($name);
$api = new Api($keyId, $keySecret);
$firstname='Your'; 
$lastname='Name';
 $email="a@h.com";
$mobile=90889;
$address="sss";
$note="xxx";
// $sql="SELECT * from products WHERE pid=:pid"; 
//          $stmt = $db->prepare($sql);
//            $stmt->bindParam(':pid',$pid,PDO::PARAM_INT);
//             $stmt->execute();
//            $row=$stmt->fetch();
//            $price=$row['price'];
//            $_SESSION['price']=$price;
//            $title=$row['title'];  
$price=$tot;
$title="xxx";
$webtitle='Techno Smarter'; // Change web title
$displayCurrency='INR';
$imageurl='https://technosmarter.com/assets/images/Avatar.png'; //change logo from here
$orderData = [
    'receipt'         => 3456,
    'amount'          => $price * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $webtitle,
    "description"       => $title,
    "image"             => $imageurl,
    "prefill"           => [
    "name"              => $firstname.' '.$lastname,
    "email"             => $email,
    "contact"           => $mobile,
    ],
    "notes"             => [
    "address"           => $address,
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
echo $u_id;
$sql="SELECT * FROM register WHERE id=:u_id";
$stmt=$db->prepare($sql);
$stmt->execute(['u_id'=>$u_id]);
$user = $stmt->fetch(PDO::FETCH_OBJ);        

 ?>
				<div class="row"> 
					<div class="col-8 row"> 
              <div class="col">
              <h4>(Payer Details)</h4>
                <div class="mb-3">
                  <label  class="label">First Name :-<?php echo $user->name; ?></label>
                  
                </div>

                <div class="mb-3">
                  <label class="label">Email:- </label>
                    <?php echo $user->email; ?>
                </div>
                <div class="mb-3">
                  <label class="label">Mobile:- </label>
                    <?php echo $user->phone; ?>
                </div>
              </div>
              <div class="col">
                <h4>Booking details</h4>
              <table class="table">
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
              </div>
  

					</div>
					<div class="col-4 text-center">
					 <?php 
					//  $sql="SELECT * from products WHERE pid=:pid"; 
//          $stmt = $db->prepare($sql);
//            $stmt->bindParam(':pid',$pid,PDO::PARAM_INT);
//             $stmt->execute();
//            $row=$stmt->fetch();
//   //      echo '<div class="card" style="width: 18rem;">
//   // <img class="card-img-top" src="uploads/'.$row['image'].'" alt="Card image cap">
//   // <div class="card-body">
//   //   <h5 class="card-title">'.$row['title'].'</h5>
//   //   <p class="card-text">'.$row['price'].' INR</p>
// //   </div>
// // </div>';
// 				?> 
				<br>
     
   <form action="verify.php" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-notes.shopping_order_id="<?php echo $pid;?>"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="shopping_order_id" value="<?php echo $pid;?>">
</form>


				</div>
				</div>
		</div>
	</div>
</div>
</body>
</html>