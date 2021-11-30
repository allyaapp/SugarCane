<?php

require ("../koneksi.php");

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
    <title>User's Data | SUGAR CANE</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

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
                            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
                            <img class="img-profile rounded-circle" src="../images/user.png" width="70%" style="border-radius: 50px;">
                        </a>
                        <!-- Dropdown - User Information -->
                        <ul class="dropdown-menu" style="border-radius: 5px;">
                            <div class="dropdown-divider"></div>
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
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
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="../admin/adminhome.php">
                                <i class="material-icons">account_box</i>
                                <span>Admins</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="userhome.php">
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
                                    <a href="../barang/baranghome.php">
                                        <span>Barang</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../barang/detailukuran.php">
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
                                    <a href="../transaksi/transaksihome.php">
                                        <span>Transaksi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../transaksi/detailtransaksi.php">
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
                <a href="../logout.php">
                    <button type="button" class="btn bg-red btn-block waves-effect">LOGOUT</button>
                </a>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        </section>

        <!-- Content -->
            <section class="content">
                <div class="container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                USER's DATA
                            </h2>
                            <a href="usercreate.php"> 
                                <button type="button" class="btn bg-light-green waves-effect" style="border-radius: 3px;">
                                    <i class="material-icons">create</i>
                                    <span>Create Data</span>
                                </button>
                            </a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Lengkap</th>
                                            <th>Alamat</th>
                                            <th>No. HP</th>
                                            <th>Username</th>
                                            <th>Menu</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                        $batas = 10;
                                        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                                        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;    

                                        $previous = $halaman - 1;
                                        $next = $halaman + 1;
                                        
                                        $data = mysqli_query($koneksi, "SELECT * FROM user");
                                        $jumlah_data = mysqli_num_rows($data);
                                        $total_halaman = ceil($jumlah_data / $batas);

                                        $query = "SELECT * FROM user";
                                        $result = mysqli_query($koneksi, $query);
                                        $no = $halaman_awal+1;

                                        if ($sesLvl == 1){
                                            $dis = "";
                                        } else {
                                            $dis = "disabled";
                                        }

                                        while ($row = mysqli_fetch_array($result)){
                                            $id = $row['id_user'];
                                            $nama = $row['fullname'];
                                            $alamat = $row['alamat'];
                                            $no_hp = $row['no_hp'];
                                            $username = $row['username'];
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $nama; ?></td>
                                            <td><?php echo $alamat; ?></td>
                                            <td><?php echo $no_hp; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                                <a href="useredit.php?id=<?php echo $row['id_user']; ?>">
                                                    <input type="button" class="btn btn-info" value="Edit" name="edit" <?php echo $dis; ?>>
                                                </a>
                                                <a href="userdelete.php?id=<?php echo $row['id_user']; ?>">
                                                    <input type="button" class="btn btn-danger" value="Delete" name="delete" <?php echo $dis; ?>>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <nav>
                                    <ul class="pagination table-bordered">
                                        <li>
                                            <a class="waves-effect" <?php if($halaman > 1){ echo "href='userhome.php?halaman=$previous'";} ?> >
                                                PREVIOUS
                                                <!-- <i class="material-icons">chevron_left</i> -->
                                            </a>
                                        </li>

                                        <?php 
                                            for($x=1; $x<=$total_halaman; $x++){
                                        ?>
                                            <li><a class="waves-effect" href="userhome.php?halaman=<?php echo $x ?>"><?php echo $x; ?><!-- &nbsp;&nbsp;| --></a></li>
                                        <?php
                                            }
                                        ?>  

                                        <li>
                                            <a class="waves-effect" <?php if($halaman < $total_halaman){ echo "href='userhome.php?halaman=$next'";} ?>>
                                                NEXT
                                                <!-- <i class="material-icons">chevron_right</i> -->
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>
        <!-- #Content -->

    <!-- Jquery Core Js -->
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
    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>
