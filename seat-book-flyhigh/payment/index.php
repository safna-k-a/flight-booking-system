<?php require_once("config.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shop - Techno Smarter </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-12 form-container">
				<h1>Shop </h1>
<hr>
				<div class="row"> 
					<?php 
					 $sql="SELECT * from products order by pid DESC"; 
         $stmt = $db->prepare($sql);
           $stmt->execute();
           $rows=$stmt->fetchAll();
           foreach ($rows as $row) {
       echo '<div class="col-4 text-center"><div class="card" style="width: 18rem;">
  <img class="card-img-top" src="uploads/'.$row['image'].'" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">'.$row['title'].'</h5>
    <p class="card-text">'.$row['price'].' INR</p>
    <a href="checkout.php?product_id='.$row['pid'].'" class="btn btn-primary">Buy Now</a>
  </div>
</div></div>';

}
				?> 
				</div>
		</div>
	</div>
</div>
</body>
</html>