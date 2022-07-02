<?php
//session_start();
  include('./conn.php'); 
  
  if (!isset($_SESSION['id_adm'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cloud Storage - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
   .container_{margin:10px;padding:5px;border:solid 1px #eee;}
   .image_upload > input{display:none;} 
  </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-cloud"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Cloud<sup>Storage</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
           
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pages
            </div>
            
            <li class="nav-item ">
                <a class="nav-link" href="picture.php">
                    <i class="fas fa-fw fa-image"></i>
                    <span>Picture</span></a>
            </li>
            

            <!-- Nav Item - Charts -->
            <li class="nav-item ">
                <a class="nav-link" href="video.php">
                    <i class="fas fa-fw fa-film"></i>
                    <span>Video</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="file.php">
                    <i class="fas fa-fw fa-file"></i>
                    <span>File</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="note.php">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Note</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>

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

        <!-- Topbar Search -->
       

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <?php $name = $_SESSION['nama'];
                $queryAdmin = "SELECT * FROM tb_admin where nama_adm = '$name'";
                $resultAdmin = mysqli_query($conn, $queryAdmin);
                while($row = mysqli_fetch_assoc($resultAdmin))
                {?>
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row['nama_adm'];?></span>
                    <?php
                }
                ?>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="editProf.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                       Edit Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">File</h1>
</div>
    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Upload File</h6>
                                </div>
                                <div class="card-body">
                               
                                <form method="POST" action="editFile_proses.php"  enctype="multipart/form-data" class="user">
                                <?php
                                    $id = $_GET['id'];
                                    $query = "SELECT * FROM tb_file WHERE id_file ='$id' ";
                                    $result = mysqli_query($conn, $query);
                                    if(!$result){
                                        die ("Query Error: ".mysqli_errno($conn).
                                        " - ".mysqli_error($conn));
                                    }
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                    ?>
                                <div class="form-group">
                                    <span> Nama : </span><br>
                                   
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInpputName" name="nama" placeholder="Nama" value="<?php echo $row['nama_file'];?>">
                                </div>
                                <div class="form-group">
                                <p>
    Sisipkan File ( Max 10Mb ):
    </p>
    <p class="image_upload">
    <label for="userImage">
    <a class="btn btn-info btn-sm" rel="nofollow"><span class='glyphicon glyphicon-paperclip'></span> Sisipkan File</a>
    </label>
    <input type="file" accept=".pdf" name="file" id="userImage" required="" /><?php echo $row['url_file'];?>
    <input type="hidden" name="id_file" autofocus="" required="" value="<?php echo $row['id_file'];}?>"/>
</p>
                                </div>

                                <input type="button" value="Upload" onclick="this.form.submit();" class="btn btn-primary btn-user btn-block"/>
                                <hr>
                            </form>    
                                  
                                </div>
                            </div>
    </div>
    <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2022</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>