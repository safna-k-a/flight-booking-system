<?php
session_start();
require '../../connection.php';
require '../header.php';
$url=isset($_SERVER['HTTPS']) &&
    $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";  
 
$url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['url']= $url;
if(!isset($_SESSION['email'])) {
   
    echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please Register before Booking',
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                window.location='../../login.php';
              });

            </script>";
}
else{
    
}

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

}


?>
<div class="container-fluid m-0 p-0">
            <!-- nav bar start -->
            <div class="row m-0 p1 py-5">
                <div class="col-12 text-center text-white py-4">
                    <div class="row">
                        <div class="col-4">
                            <a href="search.php?id=1" class="border-0 btn">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="30"
                                    height="26"
                                    fill="currentcolor"
                                    class="bi bi-arrow-left-circle-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"
                                    />
                                </svg>
                            </a>
                        </div>
                        <div class="col-4">
                            <h1><strong><?=$depart->abbr ?>-<?=$arrival->abbr ?></strong></h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- nav bar end -->
            <!-- .First flight details start -->
            <div
                class="container col-12 col-lg-9 bg-light mt-2 rounded-4 border"
            >
                <div class="row justify-content-center text-center">
                    <div class="col-3 col-lg-3">
                        <p><?=$depart->name ?></p>
                        <p class="fw-bolder fs-1"><?=$depart->abbr ?></p>
                        <p><?=$fly->depart_time ?></p>
                        <p><?=$fly->depart_date ?></p>
                    </div>

                    <div class="col-5 col-lg-6">
                        <p class="text-center mt-4">non-stop</p>
                        <i class="fa-solid fa-plane"></i>
                        <div class="border border-2 border-dark"></div>
                        <p class="text-center mt-3">2200Km 4hr 30m</p>
                    </div>

                    <div class="col-3 col-lg-3">
                        <p><?=$arrival->name ?></p>
                        <p class="fw-bolder fs-1"><?=$arrival->abbr ?></p>
                        <p><?=$fly->arr_time ?></p>
                        <p><?=$fly->arr_date ?></p>
                    </div>
                </div>

                <div class="text-center">
                    <a
                        href="bookingconfirm.php?id=<?=$fly->id?>"
                        class="fs-2 fw-bold text-decoration-none"
                    >
                        Buy &#x20B9;<?=$fare->economy_rate;?>
                    </a>
                </div>
            </div>
            <?php
        require '../../footer.php';
    ?>