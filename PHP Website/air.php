<!--
air.php
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

    <title>AquaSense - Air</title>

    <link rel="aquasense icon" href="img/icon.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


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

        $sql = "SELECT * FROM sensors ORDER BY id DESC";
        $sql_time = "SELECT date, time FROM sensors ORDER BY id DESC LIMIT 1";
        $sql_light = "SELECT light FROM sensors ORDER BY id DESC LIMIT 1";
        $sql_atemp = "SELECT atemp, humidity FROM sensors ORDER BY id DESC LIMIT 1";
        

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
            <li class="nav-item active">
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

                    <!-- Generate PDF -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <button type="button" id="download" class="btn btn-info">Generate PDF</button>
                    </div>

                    <div class="row justify-content-center">

                        <div class="col-lg-3">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4 ">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Current Light Reading</h6>
                                </div>
                                <div class="card-body">
                                    <div class=" mb-4">
                                        <?php
                                            if ($result = $conn->query($sql_light)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $row_light = $row["light"];
                                        ?>
                                        <div class="card h2 bg-white shadow align-items-center">
                                            <div class="card-body">
                                                
                                                <?php echo $row_light;?>
                                                <img src="
                                                <?php
                                                    if ($row_light == "OFF"){echo "img/light_off.png";}
                                                    else{echo "img/light.png";}
                                                ?>" width="60" height="60">
                                                
                                            </div>
                                        </div>
                                        <?php
                                                }

                                                $result->free();
                                            }
                                            
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4 ">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Current Air Temperature</h6>
                                </div>
                                <div class="card-body">
                                    <div class=" mb-4">
                                        <?php
                                            if ($result = $conn->query($sql_atemp)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $row_atemp = $row["atemp"];
                                        ?>
                                        <div class="card h2 bg-white shadow align-items-center">
                                            <div class="card-body">
                                                
                                                <?php $row_atemp= 30.1; echo $row_atemp . "<sup> o</sup>C";?>
                                                <img src="img/atemp.png" width="60" height="60">
                                                
                                            </div>
                                        </div>
                                        <?php
                                                }

                                                $result->free();
                                            }
                                            
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-3">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4 ">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Current Humidity</h6>
                                </div>
                                <div class="card-body">
                                    <div class=" mb-4">
                                        <?php
                                            if ($result = $conn->query($sql_atemp)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $row_humidity = $row["humidity"];
                                        ?>
                                        <div class="card h2 bg-white shadow align-items-center">
                                            <div class="card-body">
                                                
                                                <?php $row_humidity= 64; echo $row_humidity;?>
                                                <img src="img/humidity.png" width="60" height="60">
                                                
                                            </div>
                                        </div>
                                        <?php
                                                }

                                                $result->free();
                                            }
                                            
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    
                    <div id="data" class="row justify-content-center">
                        <!-- Basic Card Example -->
                        <div class="col-lg-10 card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Aquarium Air & Humidity Temperatures</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Temp ( <sup>o</sup>C )</th>
                                                <th>Humidity ( % )</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if ($result = $conn->query($sql)) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        
                                                        $row_date = $row["date"];
                                                        $row_time = $row["time"];
                                                        $row_atemp = $row["atemp"];
                                                        $row_humidity = $row["humidity"];
                                                        
                                            ?>
                                            <tr>
                                                <td><?php echo $row_date; ?></td>
                                                <td><?php echo date('g:i A',strtotime($row_time)); ?></td>
                                                <td><?php echo $row_atemp; ?></td>
                                                <td><?php echo $row_humidity; ?></td>
                                            </tr>
                                            <?php
                                                    }

                                                    $result->free();
                                                }
                                                $conn->close();
                                            ?>
                                            <!-- End of PHP -->
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</body>

<script>
        window.onload = function () {
        document.getElementById("download")
            .addEventListener("click", () => {
                const data = this.document.getElementById("data");
                console.log(data);
                console.log(window);
                var opt = {
                    margin: 0.1,
                    filename: 'AirSensorData(Aquasense).pdf',
                    image: { type: 'jpeg', quality: 1.98 },
                    html2canvas: { scale: 3 },
                    jsPDF: { unit: 'in', format: 'legal', orientation: 'portrait' }
                };
                html2pdf().from(data).set(opt).save();
            })
        }
</script>

</html>