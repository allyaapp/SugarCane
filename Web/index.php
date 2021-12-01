<?php

require ("koneksi.php");

session_start();

if(!isset($_SESSION['id'])){
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini!';
    header('Location: login.php');
}
$sesID = $_SESSION['id'];
$sesName = $_SESSION['username'];
$sesLvl = $_SESSION['role'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | SUGAR CANE</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-green">
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
   
    <!-- Top Bar -->
    <nav class="navbar" style="background-color: #1FA444;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <p class="navbar-brand" style="size: 25px;"><b>SUGAR CANE</a></b></p>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    
                    <!-- Name -->
                    <li class="dropdown">
                        <a class="dropdown-toggle font-15">
                            <?php echo $sesName; ?>
                        </a>
                    </li>
                    <!-- #END# Name -->

                   <!-- User Info   -->
                   <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <img class="img-profile rounded-circle" src="images/user.png" width="70%" style="border-radius: 50px;">
                        </a>
                        <!-- Dropdown - User Information -->
                        <ul class="dropdown-menu" style="border-radius: 5px;">
                            <div class="dropdown-divider"></div>
                            <li>
                                <a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a>
                            </li>
                            <div class="dropdown-divider"></div>
                        </ul>
                    </li>
                    <!-- #User Info -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <div class="hover-expand-effect">
                        <li class="active">
                            <a href="index.php">
                                <i class="material-icons">home</i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="admin/adminhome.php">
                                <i class="material-icons">account_box</i>
                                <span>Admins</span>
                            </a>
                        </li>
                        <li>
                            <a href="user/userhome.php">
                                <i class="material-icons">person</i>
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">library_books</i>
                                <span>Data Barang</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="barang/baranghome.php">
                                        <span>Barang</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="barang/detailukuran.php">
                                        <span>Detail Ukuran</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">assessment</i>
                                <span>Transaksi</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="transaksi/transaksihome.php">
                                        <span>Transaksi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="transaksi/detailtransaksi.php">
                                        <span>Detail Transaksi</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>
                </ul>
            </div>
            <!-- #Menu -->

            <!-- Footer -->
            <div class="legal">
                <button type="button" data-color="red" class="btn bg-red btn-block waves-effect m-r-20" data-toggle="modal" data-target="#modallogout">LOGOUT</button>
            </div>
            <!-- #Footer -->

        </aside>
        <!-- #END# Left Sidebar -->
        </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h1 style="color: gray;"><b>DASHBOARD</b></h1>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow hover-expand-effect" style="border-radius: 5px;">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <?php 
                            $query = mysqli_query($koneksi, "SELECT * FROM admindetail");
                            $data = array();
                            while(($row = mysqli_fetch_array($query)) !=null){
                                $data[] = $row;
                            }
                            $cont = count($data);

                        ?>
                        <div class="content">
                            <div class="text">ADMIN</div>
                            <div class="number"><?php echo $cont; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect" style="border-radius: 5px;">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <?php 
                            $query = mysqli_query($koneksi, "SELECT * FROM user");
                            $data = array();
                            while(($row = mysqli_fetch_array($query)) !=null){
                                $data[] = $row;
                            }
                            $cont = count($data);

                        ?>
                        <div class="content">
                            <div class="text">PENGGUNA</div>
                            <div class="number"><?php echo $cont; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect" style="border-radius: 5px;">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <?php 
                            $query = mysqli_query($koneksi, "SELECT * FROM barang");
                            $data = array();
                            while(($row = mysqli_fetch_array($query)) !=null){
                                $data[] = $row;
                            }
                            $cont = count($data);

                        ?>
                        <div class="content">
                            <div class="text">JUMLAH BARANG</div>
                            <div class="number"><?php echo $cont; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect" style="border-radius: 5px;">
                        <div class="icon">
                            <i class="material-icons">assessment</i>
                        </div>
                        <?php 
                            $query = mysqli_query($koneksi, "SELECT * FROM transaksi");
                            $data = array();
                            while(($row = mysqli_fetch_array($query)) !=null){
                                $data[] = $row;
                            }
                            $cont = count($data);

                        ?>
                        <div class="content">
                            <div class="text">TRANSAKSI</div>
                            <div class="number"><?php echo $cont; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>SUGARCANE</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>BROWSER USAGE</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modallogout" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <!-- konten modal-->
                <div class="modal-content">
                    <!-- heading modal -->
                    <div class="modal-header">
                        <h3 class="modal-title" id="modallogoutLabel">Confirm Logout</h3
                            >
                    </div>
                    <!-- body modal -->
                    <div class="modal-body">
                        <h5>Are you sure you want to logout?</h5>
                    </div>
                    <!-- footer modal -->
                    <div class="modal-footer">
                        <a href="logout.php">
                            <button type="button" class="btn btn-link waves-effect">Yes</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancel</button>
                        </a>
                    </div>
                </div>
        </div>
    </div>
    <!-- #Modal -->

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>
    <script src="js/pages/ui/modals.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>
