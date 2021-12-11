<?php
require ('koneksi.php');

session_start();

//session
$sesID = $_SESSION['id'];
$sesName = $_SESSION['username'];
$sesLvl = $_SESSION['role'];
$sesImg = $_SESSION['foto'];
$path = 'images/admin/';

if(isset($_POST['update'])){
        $id = $_POST['id_admin'];
        $fullname = $_POST['fullname'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "UPDATE admindetail SET fullname='$fullname', no_hp ='$no_hp', alamat = '$alamat', username = '$username', password = '$password' WHERE admindetail.id_admin = '$id'";
        $result = mysqli_query($koneksi, $query);
        header('Location: editprofile.php');
}

    $query = "SELECT * FROM admindetail WHERE id_admin='$sesID'";
    $result = mysqli_query($koneksi, $query) or die (mysql_error());
    while ($row = mysqli_fetch_array($result)){
        $id_admin = $row['id_admin'];
        $fullname = $row['fullname'];
        $no_hp = $row['no_hp'];
        $alamat = $row['alamat'];
        $username = $row['username'];
        $password = $row['password'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Profile | SUGAR CANE</title>
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
</head>

<body class="login-page">
    <div class="login-box">
        <div class="card">
            <div class="body">
                <center><img src="<?php echo $path.$sesImg; ?>" alt="avatar" width="160" height="160"
                    style="margin-top: -60px;
                    border-radius:90px;">
                </center>
                <form id="sign_in" method="POST" action="editprofile.php">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">assignment_ind</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="id_admin" value="<?php echo $id_admin;?>" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="fullname" value="<?php echo $fullname;?>" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">location_on</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="alamat" value="<?php echo $alamat;?>" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">call</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="no_hp" value="<?php echo $no_hp;?>" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" value="<?php echo $username;?>" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" value="<?php echo $password;?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <a href="index.php"><u>Back</u></a>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-green waves-effect" type="submit" name="update">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/ui/dialogs.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>
</body>

</html>