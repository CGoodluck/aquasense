<!--
index.php
Aquasense

Created by Christopher Goodluck on 05/01/2021.
Copyright (c) 2021 All rights reserved.
-->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Computer Science Major Research Project">
    <meta name="author" content="Christopher Goodluck">
    <meta http-equiv="refresh" content="360">

    <title>AquaSense - Home</title>

    <link rel="aquasense icon" href="img/icon.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Start of PHP -->
    <?php

        $servername = "localhost";
        $dbname = "aqua_sense";
        $username = "root";
        $password = "";
        $id = 1;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM sensors ORDER BY id DESC LIMIT 1";

        $sql_email = "SELECT * FROM `owners` WHERE `id` = $id";

    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- BRAND -->
                    
                </div>
                <div class="sidebar-brand-text mx-3">AquaSense</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <span>
                        <h5>Home</h5>
                    </span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="water.php">
                    <span>
                        <h5>Water</h5>
                    </span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="ph.php">
                    <span>
                        <h5>pH</h5>
                    </span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="air.php">
                    <span>
                        <h5>Air</h5>
                    </span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="alldata.php">
                    <span>
                        <h5>All Data</h5>
                    </span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="about.php">
                    <span>
                        <h5>About</h5>
                    </span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        </ul>
        <!-- End of Sidebar -->

        <!-- PHP Database Selection -->
        <?php
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                
                $row_date = $row["date"];
                $row_time = $row["time"];
                $row_wtemp = $row["wtemp"];
                $row_ph = $row["ph"];
                $row_wlevel = $row["wlevel"];
                //$row_atemp = $row["atemp"];
                $row_atemp = 30.1;
                //$row_humidity = $row["humidity"];
                $row_humidity = 64;
                $row_light = $row["light"];
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->

                    <ul class="navbar-nav ml-auto">

                        <div> 
                            <span>Last Updated - </span><b>
                            <?php
                                date_default_timezone_set("Etc/GMT+4");

                                $date = date("d");

                                $date2 = date('d',strtotime($row_date));

                                if ($date == $date2) {
                                    echo "Today @ " . date('g:i A',strtotime($row_time));
                                }
                                else if (($date - 1) == $date2) {
                                    echo "Yesterday @ " . date('g:i A',strtotime($row_time));
                                }
                                else if (($date - 2) == $date2 || ($date - 3) == $date2 || ($date - 4) == $date2 || ($date - 5) == $date2) {
                                    echo date('l',strtotime($row_date)) . " @ ". date('g:i A',strtotime($row_time));
                                }
                                else {
                                    echo $row_date . " @ " . date('g:i A',strtotime($row_time));
                                }
                            ?></b>
                        </div>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php
                        if ($result = $conn->query($sql_email)) {
                            while ($row = $result->fetch_assoc()) {
                    
                                $name = $row['first_name'] . " " . $row['last_name'];
                                //$email = $row['email'];
                            }
                        }
                    ?>
                    <h1 class="h3 mb-4 text-gray-800"><?php echo $name ?>'s Aquarium</h1>
                    

                    <div class="row justify-content-center">

                        <!-- wtemp-->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href="water.php" style="text-decoration: none;">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Water Temperature</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800"> 
                                                <?php
                                                    echo $row_wtemp;
                                                ?>
                                            <sup>o</sup>C</div>
                                        </div>
                                        <div class="col-auto">
                                            <!--ICON-->
                                            <img src="img/wtemp.png" width="75" height="75" >
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                        </div>

                        <!-- ph -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href="ph.php" style="text-decoration: none;">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                pH Value</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    echo $row_ph;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!--ICON-->
                                            <img src="
                                                <?php
                                                    $row_ph = intval($row_ph);

                                                    if ($row_ph == 0){echo "img/ph/0.png";}
                                                    elseif ($row_ph == 1){echo "img/ph/1.png";}
                                                    elseif ($row_ph == 2){echo "img/ph/2.png";}
                                                    elseif ($row_ph == 3){echo "img/ph/3.png";}
                                                    elseif ($row_ph == 4){echo "img/ph/4.png";}
                                                    elseif ($row_ph == 5){echo "img/ph/5.png";}
                                                    elseif ($row_ph == 6){echo "img/ph/6.png";}
                                                    elseif ($row_ph == 7){echo "img/ph/7.png";}
                                                    elseif ($row_ph == 8){echo "img/ph/8.png";}
                                                    elseif ($row_ph == 9){echo "img/ph/9.png";}
                                                    elseif ($row_ph == 10){echo "img/ph/10.png";}
                                                    elseif ($row_ph == 11){echo "img/ph/11.png";}
                                                    elseif ($row_ph == 12){echo "img/ph/12.png";}
                                                    elseif ($row_ph == 13){echo "img/ph/13.png";}
                                                    elseif ($row_ph == 14){echo "img/ph/14.png";}
                                                    else{echo "img/ph/ph.png";}
                                                ?> " width="75" height="75">
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                    
                    </div>
                    <div class="row justify-content-center">

                        <!-- wlevel -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href="water.php" style="text-decoration: none;">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Water Level</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    echo $row_wlevel;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!--ICON-->
                                            <img src="
                                                <?php
                                                    if ($row_wlevel == "NORMAL"){echo "img/wlevel.png";}
                                                    elseif ($row_wlevel == "LOW"){echo "img/wlevel_low.png";}
                                                    else{echo "img/wlevel_empty.png";}
                                                ?> " width="75" height="75">
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                        </div>

                        <!-- atemp -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href="air.php" style="text-decoration: none;">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Air Temperature</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    echo $row_atemp;
                                                ?>
                                            <sup>o</sup>C</div>
                                        </div>
                                        <div class="col-auto">
                                            <!--ICON-->
                                            <img src="img/atemp.png" width="75" height="75">
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                    
                    </div>
                    <div class="row justify-content-center">

                        <!-- humidity -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href="air.php" style="text-decoration: none;">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Humidity</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    echo $row_humidity;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!--ICON-->
                                            <img src="img/humidity.png" width="75" height="75">
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                        </div>

                        <!-- light -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href="air.php" style="text-decoration: none;">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Light</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    echo $row_light;
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!--ICON-->
                                            <img src="
                                                <?php
                                                    if ($row_light == "OFF"){echo "img/light_off.png";}
                                                    else{echo "img/light.png";}
                                                ?>" width="75" height="75">
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                        </div>
                    
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; AquaSense 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

        <?php

            }
            $result->free();
            }

            $conn->close();

        ?>
        <!-- End of PHP -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>