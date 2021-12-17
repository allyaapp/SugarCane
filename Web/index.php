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
$sesImg = $_SESSION['foto'];
$path = 'images/admin/';

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
                            <img class="img-profile rounded-circle" src="<?php echo $path.$sesImg; ?>" width="36" height="36" style="border-radius: 50px; margin-top: -5px;" >
                        </a>
                        <!-- Dropdown - User Information -->
                        <ul class="dropdown-menu" style="border-radius: 5px;">
                            <div class="dropdown-divider"></div>
                                <li>
                                    <a href="editprofile.php"><i class="material-icons">person</i>Profile</a>
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
                                <span>DASHBOARD</span>
                            </a>
                        </li>
                        <li>
                            <a href="admin/adminhome.php">
                                <i class="material-icons">account_box</i>
                                <span>ADMIN</span>
                            </a>
                        </li>
                        <li>
                            <a href="user/userhome.php">
                                <i class="material-icons">person</i>
                                <span>USER</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">icecream</i>
                                <span>PRODUCT</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="barang/baranghome.php">
                                        <span>PRODUCT</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="barang/detailukuran.php">
                                        <span>SIZE DETAILS</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">equalizer</i>
                                <span>TRANSACTION</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="transaksi/transaksihome.php">
                                        <span>TRANSACTION</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="transaksi/detailtransaksi.php">
                                        <span>TRANSACTION DETAILS</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="report/report.php">
                                <i class="material-icons">library_books</i>
                                <span>REPORT</span>
                            </a>
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
                            <div class="text">USER</div>
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
                            <div class="text">PRODUCT</div>
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
                            <div class="text">TRANSACTION</div>
                            <div class="number"><?php echo $cont; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            
            <!-- Info -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                SUGARCANE
                            </h2>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#about" data-toggle="tab">ABOUT</a></li>
                                <li role="presentation"><a href="#chocolate" data-toggle="tab">CHOCOLATE</a></li>
                                <li role="presentation"><a href="#strawberry" data-toggle="tab">STRAWBERRY</a></li>
                                <li role="presentation"><a href="#vanillaoreo" data-toggle="tab">VANILLA OREO</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="about">
                                    <b>Home Content</b>
                                    <p>
                                        Sugar Cane Ice Cream merupakan es krim dengan bahan-bahan alami. Baik itu perisa yang digunakan maupun pemanis yang dibuat, salah satunya perisa yang digunakan yakni terbuat dari buah-buhan. Untuk pemanisnya dibuat dengan menggunakan sari tebu. <br>
                                        Pertama tebu diambil airnya dengan menggunakan mesin pemeras tebu. Kemudian untuk perisa pilih buah yang akan digunakan sebagai perasa alami, misalnya buah strawberry. Setelah itu kita dapat mencampur bahan-bahan utama tersebut ke dalam bubuk es krim. Juga selain itu, bisa dengan cara dipotong menjadi tiga bagian dan dijadikan topping di dalam es krim tersebut.
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="chocolate">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                                        </ol>

                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">
                                                <center><img src="images/product/chocolate-mini.jpg" width="420" height="420"/></center>
                                            </div>
                                            <div class="item">
                                                <center><img src="images/product/chocolate-jumbo.jpg" width="420" height="420"/></center>
                                            </div>
                                            <div class="item">
                                                <center><img src="images/product/chocolate-jumbo1.jpg" width="420" height="420"/></center>
                                            </div>
                                            <div class="item">
                                                <center><img src="images/product/chocolate-jumbo2.jpg" width="420" height="420"/></center>
                                            </div>
                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="strawberry">
                                    <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example" data-slide-to="1"></li>
                                            <li data-target="#carousel-example" data-slide-to="2"></li>
                                            <li data-target="#carousel-example" data-slide-to="3"></li>
                                        </ol>

                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">
                                                <center><img src="images/product/strawberry-mini.jpg" width="420" height="420"/></center>
                                            </div>
                                            <div class="item">
                                                <center><img src="images/product/strawberry-jumbo.jpg" width="420" height="420"/></center>
                                            </div>
                                            <div class="item">
                                                <center><img src="images/product/strawberry-jumbo1.jpg" width="420" height="420"/></center>
                                            </div>
                                            <div class="item">
                                                <center><img src="images/product/strawberry-jumbo2.jpg" width="420" height="420"/></center>
                                            </div>
                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="vanillaoreo">
                                    <div id="carousel-example-gen" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-gen" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example-gen" data-slide-to="1"></li>
                                            <li data-target="#carousel-example-gen" data-slide-to="2"></li>
                                            <li data-target="#carousel-example-gen" data-slide-to="3"></li>
                                        </ol>

                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">
                                                <center><img src="images/product/vanillaoreo-mini.jpg" width="420" height="420" /></center>
                                            </div>
                                            <div class="item">
                                                <center><img src="images/product/vanillaoreo-jumbo.jpg" width="420" height="420"/></center>
                                            </div>
                                            <div class="item">
                                                <center><img src="images/product/vanillaoreo-jumbo1.jpg" width="420" height="420"/></center>
                                            </div>
                                            <div class="item">
                                                <center><img src="images/product/vanillaoreo-jumbo2.jpg" width="420" height="420"/></center>
                                            </div>
                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-gen" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-gen" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #Info -->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modallogout" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <!-- konten modal-->
                    <div class="modal-content">
                        <!-- heading modal -->
                        <div class="modal-header" style="background: #FFCCCC;">
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
                                <button type="button" class="btn btn-danger waves-effect">Yes</button>
                                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Cancel</button>
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
