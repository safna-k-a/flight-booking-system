<?php
    require 'connection.php';
    session_start();
    $sql='SELECT * FROM airport';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $airports=$statement->fetchAll(PDO::FETCH_OBJ);
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location:login.php");
    
    }

?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>FlyHigh.com</title>
        <link rel="icon" href="images/favicon.PNG" type="image/x-icon" />
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
        <!-- <link rel="stylesheet" href="../../css/style.css" /> -->
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
                                src="images/logo1.png"
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
                                        href="index.php"
                                        >Home</a
                                    >
                                </li>
                                
                                <li class="nav-item">
                                    <a
                                        class="nav-link active text-black"
                                        aria-current="page"
                                        href="login.php"
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
<div class="row justify-content-center  w-50 mx-auto  mt-5 p-4 rounded-4" id="search-form">
                
                <form action="user/pages/search.php" method="POST" onsubmit="return svalidate()">
                    <div class="row  mt-3">
                    <div class="col-md-4 text-center mt-2 mb-3">
                    
                            <label  for="" class="text-white fw-semibold"
                                        >FROM</label
                                    >
                                    <select class="col-md-6 rounded-2 form-control mt-3 fc" name="depart" id="departure">
                            <option value="">Departure</option>
                            <?php foreach($airports as $airport): ?>
                            <option value="<?= $airport->id;?>"><?= $airport->name;?></option>
                            <?php
                            endforeach; ?>
                            
                        </select>
        </div>
        <div class="col-md-4  text-center mt-2 mb-3">
        <label  for="" class="text-white fw-semibold"
                            >TO</label
                        >
                        <select class="col-md-6 rounded-2 form-control fc mt-3" name="arrival" id="arrival">
                            <option value="">Arrival</option>
                            <?php $i=1; foreach($airports as $airport): ?>
                            <option value="<?= $airport->id;?>"><?= $airport->name;?></option>
                            <?php $i=$i+1;
                            endforeach; ?>
                            
                        </select>
        </div>
        <div class="col-md-4 mt-md-2 mt-3 mb-3">
        <label for="" class="text-white fw-semibold">DATE</label>
            <input type="date" name="date" id="date" class=" mt-3 form-control fc">
        </div>


        <div class="text-center my-3">
                        <input id="ind-btn"
                            class="btn btn-primary text-dark"
                            type="submit"
                            value="search"
                            name="submit"
                        />
        </div>
    </div>

    </form>
</div>

<?php

    require 'footer.php';
    
?> 