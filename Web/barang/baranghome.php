<?php

require ("../koneksi.php");

session_start();

//session
$sesID = $_SESSION['id'];
$sesName = $_SESSION['username'];
$sesLvl = $_SESSION['role'];
$sesImg = $_SESSION['foto'];
$path = '../images/admin/';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Our Product | SUGAR CANE</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

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
                        <li class="active">
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">icecream</i>
                                <span>PRODUCT</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="active">
                                    <a href="baranghome.php">
                                        <span>PRODUCT</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="detailukuran.php">
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
                                    <a href="../transaksi/transaksihome.php">
                                        <span>TRANSACTION</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../transaksi/detailtransaksi.php">
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
                <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DETAIL PRODUCTS
                            </h2>
                            <a href="barangcreate.php"> 
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
                                            <th>Varian</th>
                                            <th>Ukuran</th>
                                            <th>Detail Ukuran</th>
                                            <th>Stok</th>
                                            <th>Gambar</th>
                                            <th>Menu</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                        $batas = 8;
                                        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
                                        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;    

                                        $previous = $halaman - 1;
                                        $next = $halaman + 1;
                                        
                                        $data = mysqli_query($koneksi, "SELECT * FROM barang");
                                        $jumlah_data = mysqli_num_rows($data);
                                        $total_halaman = ceil($jumlah_data / $batas);
                                
                                        $query = "SELECT * FROM barang limit $halaman_awal, $batas";
                                        $result = mysqli_query($koneksi, $query);
                                        $no = $halaman_awal+1;

                                        if ($sesLvl == 1){
                                            $dis = "";
                                        } else {
                                            $dis = "disabled";
                                        }

                                        while ($row = mysqli_fetch_array($result)){
                                            $id = $row['id_barang'];
                                            $varian = $row['varian'];
                                            $ukuran = $row['ukuran'];
                                            $detailukuran = $row['id_detailukuran'];
                                            $stok = $row['stok'];
                                            $gambar = $row['gambar'];
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $varian; ?></td>
                                            <td><?php echo $ukuran; ?></td>
                                            <td><?php echo $detailukuran; ?></td>
                                            <td><?php echo $stok; ?></td>
                                            <td><?php echo "<center><img src='../images/product/$gambar' width='90' height='90'></center>" ?></td>
                                            <td>
                                                <a href="barangedit.php?id=<?php echo $row['id_barang']; ?>">
                                                    <input type="button" class="btn btn-info" value="Edit" name="edit" <?php echo $dis; ?>>
                                                </a>
                                                <a href="barangdelete.php?id=<?php echo $row['id_barang'];?>" onclick="return confirm('Do you want to delete these records? This action cannot be undone. You will be unable to recover any data.');">
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
                                        <a class="waves-effect" <?php if($halaman > 1){ echo "href='baranghome.php?halaman=$previous'";} ?> >
                                            PREVIOUS
                                            <!-- <i class="material-icons">chevron_left</i> -->
                                        </a>
                                    </li>

                                    <?php 
                                        for($x=1; $x<=$total_halaman; $x++){
                                    ?>
                                        <li><a class="waves-effect" href="baranghome.php?halaman=<?php echo $x ?>"><?php echo $x; ?><!-- &nbsp;&nbsp;| --></a></li>
                                    <?php
                                        }
                                    ?>  

                                    <li>
                                        <a class="waves-effect" <?php if($halaman < $total_halaman){ echo "href='baranghome.php?halaman=$next'";} ?>>
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