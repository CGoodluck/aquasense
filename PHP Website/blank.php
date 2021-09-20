<!--
blank.php
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

    <title>AquaSense - Blank</title>

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

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM sensors ORDER BY id DESC LIMIT 5";
        $sql_time = "SELECT date, time FROM sensors ORDER BY id DESC LIMIT 1";

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
            <li class="nav-item">
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

        <!-- PHP DATE/TIME Database Selection -->
        <?php
            if ($result = $conn->query($sql_time)) {
                while ($row = $result->fetch_assoc()) {
                
                $row_date = $row["date"];
                $row_time = $row["time"];
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

                <?php

                    }
                    $result->free();
                    }

                    //End of DATE/TIME PHP                     
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
                    <div>
                        <?php
                            if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_assoc()) {
                                
                                    #$row_ph = $row["ph"];
                                    #echo "PH: " . $row_ph . ", ";
                                }

                                $result->free();
                            }
                            $conn->close();
                        ?>
                        <!-- End of PHP -->
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