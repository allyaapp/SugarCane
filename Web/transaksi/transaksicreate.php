<?php

require ("../koneksi.php");

session_start();

//session
$sesID = $_SESSION['id'];
$sesName = $_SESSION['username'];
$sesLvl = $_SESSION['role'];
$sesImg = $_SESSION['foto'];
$path = '../images/admin/';

if(isset ($_POST['create']) ){
    //mengambil nilai dari form.
    $id_transaksi = $_POST['id_transaksi'];
    $id_admin = $_POST['id_admin'];
    $id_user = $_POST['id_user'];
    $tgltransaksi = $_POST['tgltransaksi'];
    $ongkir = $_POST['ongkir'];
    $totalharga = $_POST['totalharga'];
    $status = $_POST['status'];

    //query create 
    $query = "INSERT INTO transaksi VALUES ('', '$id_admin', '$id_user', '$tgltransaksi', '$ongkir', '$totalharga', '$status')";
    $result = mysqli_query($koneksi, $query);
    
    //percabangan jika !$result, maka muncul alert tidak dapat disimpan.
    if (!$result) {
        echo "<script> alert('The record couldn't be saved!') </script>";
        echo "<script> location='transaksicreate.php'; </script>";
    } else {
    //else, akan dibawa ke halaman barang home
        echo "<script> alert('Succesfully saved!') </script>";
        echo "<script> location='transaksihome.php'; </script>";
    }
}
  
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Create Transaction Data | SUGAR CANE</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
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

                   <!-- User Info -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <img class="img-profile rounded-circle" src="<?php echo $path.$sesImg; ?>" width="36" height="36" style="border-radius: 50px; margin-top: -5px; margin-left: 5px;" >
                        </a>
                        <!-- Dropdown - User Information -->
                        <ul class="dropdown-menu" style="border-radius: 5px;">
                            <div class="dropdown-divider"></div>
                            <li><a href="../editprofile.php"><i class="material-icons">person</i>Profile</a></li>
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
                        <li>
                            <a href="../index.php">
                                <i class="material-icons">home</i>
                                <span>DASHBOARD</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/adminhome.php">
                                <i class="material-icons">account_box</i>
                                <span>ADMIN</span>
                            </a>
                        </li>
                        <li>
                            <a href="../user/userhome.php">
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
                                    <a href="../barang/baranghome.php">
                                        <span>PRODUCT</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../barang/detailukuran.php">
                                        <span>SIZE DETAILS</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li  class="active">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">equalizer</i>
                                <span>TRANSACTION</span>
                            </a>
                            <ul class="ml-menu">
                                <li  class="active">
                                    <a href="transaksihome.php">
                                        <span>TRANSACTION</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="detailtransaksi.php">
                                        <span>TRANSACTION DETAILS</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="../report/report.php">
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

        <!-- Content -->
            <section class="content">
            <!--  Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>CREATE DATA</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" action="transaksicreate.php" method="POST">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="id_admin" required>
                                        <label class="form-label">ID Admin</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="id_user" required>
                                        <label class="form-label">ID User</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label m-r-20" style="color: lightgray">Tanggal Transaksi</label>
                                    <div class="form-line">
                                        <input type="date" class="form-control" name="tgltransaksi" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ongkir" required>
                                        <label class="form-label">Ongkir</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="totalharga" required>
                                        <label class="form-label">Total Harga</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status Pengiriman</label><br>

                                    <input type="radio" name="status" value="Proses" id="Proses" class="with-gap radio-col-light-green">
                                    <label for="Proses" class="m-l-20">Proses</label><br>

                                    <input type="radio" name="status" value="Diterima" id="Diterima" class="with-gap radio-col-light-green">
                                    <label for="Diterima" class="m-l-20">Diterima</label><br>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit" name="create">CREATE</button>
                                <a href="transaksihome.php">
                                    <button class="btn btn-danger waves-effect" type="button">CANCEL</button>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Validation -->
            </section>
        <!-- #Content -->

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
                            <a href="../logout.php">
                                <button type="button" class="btn btn-danger waves-effect">Yes</button>
                                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Cancel</button>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
        <!-- #Modal -->

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/ui/modals.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>
</html>