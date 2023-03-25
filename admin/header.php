<?php
    require 'connection.php';
    session_start(); 
    $email=$_SESSION['email'];
$sql='SELECT * from register where email=:email LIMIT 1';
$statement=$connection->prepare($sql);
$statement->execute([':email'=>$email]);
$user=$statement->fetch(PDO::FETCH_OBJ);
$_SESSION['name']=$user->name;
$_SESSION['photo']=$user->photo;
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    echo "<script>window.location.href='../../../login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>FlyHigh.com</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon" />
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />
        <link
            href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
            rel="stylesheet"
        />

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect" />
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet"
        />

    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <!-- Bootstrap css  -->

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="../assets/css/style.css" rel="stylesheet" />
        <link href="../../assets/css/style.css" rel="stylesheet" />
    </head>
    <body>
        <!-- sweet alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <!-- template -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                    <img src="assets/img/logo1.png" alt="" />
                    <span class="d-block">FLYHIGH.COM </span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>
            <!-- End Logo -->
            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">
                    <li class="nav-item dropdown pe-3">
                        <a
                            class="nav-link nav-profile d-flex align-items-center pe-0"
                            href="#"
                            data-bs-toggle="dropdown"
                        >
                            <img
                                src="../uploads/<?=$user->photo?>"
                                alt="Profile"
                                class="rounded-circle"
                            />
                            <span class="d-none d-md-block dropdown-toggle ps-2"
                                ><?=$user->name?></span
                            > </a
                        ><!-- End Profile Iamge Icon -->

                        <ul
                            class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                        >
                            <li class="dropdown-header">
                                <h6><?=$user->name?></h6>
                                <span>Flyhigh.com</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="#"
                                >
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="#"
                                >
                                    <i class="bi bi-gear"></i>
                                    <span>Account Settings</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="pages-faq.html"
                                >
                                    <i class="bi bi-question-circle"></i>
                                    <span>Need Help?</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a
                                    class="dropdown-item d-flex align-items-center"
                                    href="#"
                                >
                                    <i class="bi bi-box-arrow-right"></i>
                                    <form method="POST">
                                        <button class="btn" name="logout" onclick="return confirm('Are you sure?');">Sign Out</button></form>
                                </a>
                            </li>
                        </ul>
                        <!-- End Profile Dropdown Items -->
                    </li>
                    <!-- End Profile Nav -->
                </ul>
            </nav>
        </header>
        <!-- End Header -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="https://std005.orisysacademy.com/admin/index.php">
                        <i class="bi bi-grid"></i>
                        <span><?=$user->name?></span>
                    </a>
                </li>
                <!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        data-bs-target="#components-nav"
                        data-bs-toggle="collapse"
                        href="#"
                    >
                        <i class="bi bi-menu-button-wide"></i><span>Insert</span
                        ><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul
                        id="components-nav"
                        class="nav-content collapse"
                        data-bs-parent="#sidebar-nav"
                    >
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/airline/add.php">
                                <i class="bi bi-circle"></i
                                ><span>Airlines</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/airport/add.php">
                                <i class="bi bi-circle"></i
                                ><span>Airport</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/flight/add.php">
                                <i class="bi bi-circle"></i
                                ><span>Flight</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/fly/add.php">
                                <i class="bi bi-circle"></i
                                ><span>Routes</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/fare/add.php">
                                <i class="bi bi-circle"></i
                                ><span>Fare</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End insert Nav -->

                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        data-bs-target="#forms-nav"
                        data-bs-toggle="collapse"
                        href="#"
                    >
                        <i class="bi bi-journal-text"></i><span>Update</span
                        ><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul
                        id="forms-nav"
                        class="nav-content collapse"
                        data-bs-parent="#sidebar-nav"
                    >
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/airport/update.php">
                                <i class="bi bi-circle"></i
                                ><span>Airports</span>
                            </a>
                        </li>                       
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/airline/update.php">
                                <i class="bi bi-circle"></i
                                ><span>Airlines</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/flight/update.php">
                                <i class="bi bi-circle"></i
                                ><span>Flights</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/fly/update.php">
                                <i class="bi bi-circle"></i
                                ><span>Routes</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End update Nav -->

                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        data-bs-target="#tables-nav"
                        data-bs-toggle="collapse"
                        href="#"
                    >
                        <i class="bi bi-layout-text-window-reverse"></i
                        ><span>View</span
                        ><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul
                        id="tables-nav"
                        class="nav-content collapse"
                        data-bs-parent="#sidebar-nav"
                    >
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/airport/airports.php">
                                <i class="bi bi-circle"></i><span>Airports</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/airline/airlines.php">
                                <i class="bi bi-circle"></i><span>Airlines</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/flight/flights.php">
                                <i class="bi bi-circle"></i><span>Flights</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://std005.orisysacademy.com/admin/pages/fly/fly.php">
                                <i class="bi bi-circle"></i><span>Routes</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End View Nav -->

                <li class="nav-heading">Pages</li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="users-profile.html">
                        <i class="bi bi-person"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <!-- End Profile Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-faq.html">
                        <i class="bi bi-question-circle"></i>
                        <span>F.A.Q</span>
                    </a>
                </li>
                <!-- End F.A.Q Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-contact.html">
                        <i class="bi bi-envelope"></i>
                        <span>Contact</span>
                    </a>
                </li>
                <!-- End Contact Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="pages-register.html">
                        <i class="bi bi-card-list"></i>
                        <span>Register</span>
                    </a>
                </li>
                <!-- End Register Page Nav -->
            </ul>
        </aside>
        <!-- End Sidebar-->
        <!-- End Page Title -->