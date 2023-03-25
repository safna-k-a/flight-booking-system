<?php
session_start();
    require '../../connection.php';
    // require'../../header.php';
    
    // to get the details when come back from the booking page
    if(isset($_GET['id'])){
        $depart=$_SESSION['depart'];
        $arrival=$_SESSION['arrival'];
        $date=$_SESSION['date'];
         $sql='SELECT * from fly where depart_id=:depart AND arrival_id=:arrival AND depart_date=:date';
        $statement=$connection->prepare($sql);
        $statement->execute([':depart'=>$depart,':arrival'=>$arrival,':date'=>$date]);
        $flights=$statement->fetchAll(PDO::FETCH_OBJ);
    }
    $sql='SELECT * FROM airport';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $airports=$statement->fetchAll(PDO::FETCH_OBJ);
    if(isset($_POST['depart'])&&isset($_POST['arrival'])&&isset($_POST['date'])){
       $depart= $_POST['depart'];
       $arrival= $_POST['arrival'];
       $date= $_POST['date'];
       $_SESSION['depart']=$depart;
       $_SESSION['arrival']=$arrival;
       $_SESSION['date']=$date;
        $sql='SELECT * from fly where depart_id=:depart AND arrival_id=:arrival AND depart_date=:date';
        $statement=$connection->prepare($sql);
        $statement->execute([':depart'=>$depart,':arrival'=>$arrival,':date'=>$date]);
        $flights=$statement->fetchAll(PDO::FETCH_OBJ);
        
        if(!$flights)
        { ?>
            <h1 style="color:red";>No Flights available on Chosen Date!</h1>
            
            <?php
            echo "<script>window.location='../../index.php';</script>";
        }
        
    }
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        // header("Location:login.php");
        echo "<script>window.location='../../login.php'</script>";
    
    }

?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>FlyHigh.com</title>
        <link rel="icon" href="../images/favicon.PNG" type="image/x-icon" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
            rel="stylesheet"
        />
        <!-- google font css  -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        />
        <!-- bootstrap style  -->
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="../assets/css/style.css" />

    </head>
<body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<!-- sweet alert  -->
<div class="container-fluid home text-center">
<div class="bg-transparent">
                <nav
                    class="navbar navbar-expand-lg navbar-light bg-transparent text-black"
                >
                    <div class="container-fluid">
                        <a class="navbar-brand text-black" href="#"
                            ><img
                                src="../images/logo1.png"
                                class="w-75"
                                alt="FH.logo"
                        /></a>
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div
                            class="collapse navbar-collapse"
                            id="navbarSupportedContent"
                        >
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a
                                        class="nav-link active text-black"
                                        aria-current="page"
                                        href="../../index.php"
                                        >Home</a
                                    >
                                </li>
                                
                                <li class="nav-item">
                                    <a
                                        class="nav-link active text-black"
                                        aria-current="page"
                                        href="../../login.php"
                                        >Login</a
                                    >
                                </li>
                                <li class="nav-item">
                                <form method="POST">
                                        <button class="btn" name="logout" onclick="return confirm('Are you sure?');">Sign Out</button></form>
                                </li>
                            </ul>
                           
                        </div>
                    </div>
                </nav>
            </div>
            <!-- header div  -->
<div class=" mt-5 p-5 table-responsive min-vh-100">
    <table class="table table-dark table-striped text-center">
        <thead>
            <tr>
            <th>
                 Sl No
                </th>
                <th>
                    Name
                </th>
                <th>
                    Departure
                </th>
                <th>
                    Arrival
                </th>
                <th>
                    Date
                </th>
                <th>
                    Enonomy Rate 
                </th>
                <th>
                    Business Rate
                </th>
                
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
             foreach($flights as $flight): ?>
                <tr>
                    <td><?= $i?></td>
                    <?php 
                        $id=$flight->flight_id;
                        $sql='SELECT * FROM flight where id=:id';
                        $statement=$connection->prepare($sql);
                        $statement->execute([':id'=>$id]);
                        $fly=$statement->fetch(PDO::FETCH_OBJ);
                        $depart=$flight->depart_id;
                        $sql='SELECT * FROM airport where id=:id';
                        $statement=$connection->prepare($sql);
                        $statement->execute([':id'=>$depart]);
                        $depart_name=$statement->fetch(PDO::FETCH_OBJ);
                        $arrival=$flight->arrival_id;
                        $sql='SELECT * FROM airport where id=:id';
                        $statement=$connection->prepare($sql);
                        $statement->execute([':id'=>$arrival]);
                        $arrival_name=$statement->fetch(PDO::FETCH_OBJ);
                         $sql='SELECT * FROM fare where fly_id=:id';
                        $statement=$connection->prepare($sql);
                        $statement->execute([':id'=>$flight->id]);
                        $fare=$statement->fetch(PDO::FETCH_OBJ);?>
                        <td><?=$fly->name?></td>
                        <td><?= $depart_name->name ?></td>
                        <td><?= $arrival_name->name ?></td>
                        <td><?= $flight->depart_date ?></td>
                        <td ><?= $fare-> economy_rate?></td>
                        <td ><?= $fare->business_rate?></td>
                        <td><a href="booking.php?id=<?=$flight->id ?>"class="btn btn-success">View Details</a>
                    
                </td>
                        
                </td>
                </tr>
            <tr>
            
            <?php
            $i=$i+1;
             endforeach ?>
        </tbody>
    </table>
</div> 
<?php

    require '../../footer.php';
    
?>