<?php
    session_start();
    include('../db/ketnoi.php');
    if (isset($_SESSION['idStudent'])) {
        $sqlstudent = mysqli_query($con, "SELECT * FROM student WHERE ID = '{$_SESSION['idStudent']}'");
        $rowstudent = mysqli_fetch_assoc($sqlstudent);
        $bday = new DateTime($rowstudent['DoB']); // Your date of birth
        $today = new Datetime(date('y-m-d'));
        $diff = $today->diff($bday);
        if($diff->y >= 18){
            $sqlstudent18 = mysqli_query($con, "SELECT * FROM student_from_18 WHERE ID = '{$_SESSION['idStudent']}'");
            $rowstudent18 = mysqli_fetch_assoc($sqlstudent18);
        }
        else{
            $sqlstudent18 = mysqli_query($con, "SELECT * FROM student_under_18 WHERE ID = '{$_SESSION['idStudent']}'");
            $rowstudent18 = mysqli_fetch_assoc($sqlstudent18);
        }
        $sqlcourse =  mysqli_query($con, "SELECT * FROM learn WHERE StudentID = '{$_SESSION['idStudent']}'");
        $rowcourse = mysqli_fetch_assoc($sqlcourse);
        $course = mysqli_query($con, "SELECT * FROM course WHERE CID = '{$rowcourse['CID']}'");
        $rowcourse = mysqli_fetch_assoc($course);
        $sqlleaning =  mysqli_query($con, "SELECT * FROM learningdate WHERE CID = '{$rowcourse['CID']}'");
        $rowlearing = mysqli_fetch_assoc($sqlleaning);
    }
    else {
        header('Location:../Dangnhap.php');
    }
    
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Student Profile</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
   <link href="css/style.min.css" rel="stylesheet">
   
</head>

<body>
   
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <?php 
        $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}' ");
        $row = mysqli_fetch_assoc($sql);
    ?>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="../index1.php" style="background-color: #2f323e;">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="../img/Logo.png" alt="homepage" />
                        </b>
                    </a>
                   
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3">
                                <input type="text" placeholder="Tìm Kiếm..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <li class="notification" style="margin-right:15px; color:#fff;  width: 30px ;
                                height: 30px; display: flex; align-items: center; position: relative;
                                background-color: #069c54;
                                border-radius: 30px;
                                justify-content: center;cursor:pointer">
                            
                            <i class="fas fa-bell" style="cursor:pointer"></i>
                            <span style="position:absolute;position: absolute;
                                display: flex;
                                top: -10px;
                                right: -8px;
                                background-color: #f00;
                                color: #fff;
                                width: 20px;
                                height: 20px;
                                border-radius: 20px;
                                justify-content: center;
                                align-items: center;
                                font-size: 14px;cursor:pointer">0</span>
                        </li>
                        <li class="request" style="position: relative;cursor:pointer">
                            <i class="fas fa-envelope" style="color: #fff;display: flex;
                                width: 30px;
                                height: 30px;
                                background-color: #069c54;
                                border-radius: 30px;
                                cursor: pointer;
                                color: #fff;
                                align-items: center;
                                justify-content: center;"></i>
                            <span style="position:absolute;position: absolute;
                                display: flex;
                                top: -10px;
                                right: -8px;
                                background-color: #f00;
                                color: #fff;
                                width: 20px;
                                height: 20px;
                                border-radius: 20px;
                                justify-content: center;
                                align-items: center;
                                font-size: 14px;cursor:pointer">0</span>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/varun.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium"><?php echo $rowstudent['Name'] ?></span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../index1.php"
                                aria-expanded="false">
                                <i class="fas fa-home" aria-hidden="true"></i>
                                <span class="hide-menu">Trang Chủ</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Thông Tin Học Viên</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="allcourse.php"
                                aria-expanded="false">
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span class="hide-menu">Khóa học</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="notifiresults.php"
                                aria-expanded="false">
                                <i class="fa fa-font" aria-hidden="true"></i>
                                <span class="hide-menu">Thông Báo Kết Quả</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="request.php"
                                aria-expanded="false">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <span class="hide-menu">Yêu Cầu Học Viên </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../feedback/index.php"
                                aria-expanded="false">
                                <i class="fa fa-columns" aria-hidden="true"></i>
                                <span class="hide-menu">Đánh Giá Khóa Học</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="404.php"
                                aria-expanded="false">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                <span class="hide-menu">Error 404</span>
                            </a>
                        </li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/ampleadmin/"
                                class="btn d-grid btn-danger text-white" target="_blank">
                                Đăng Ký Thành Viên Mới</a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Trang Thông Tin Học Viên</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="../index1.php" class="fw-normal">Trang Chủ</a></li>
                            </ol>
                            <a href="../Dangky.php" target="_blank"
                                class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Đăng Ký Thành Viên Mới
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="container-fluid">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="plugins/images/large/img1.jpg">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="../Chatbox/php/images/<?php echo $row['img'] ?>"
                                                class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white mt-2"><?php echo $rowstudent['Name'] ?></h4>
                                        <h5 class="text-white mt-2"><?php echo $rowstudent['Name'] ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box mt-5 d-md-flex">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <h1><?php echo $rowstudent['ID'] ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group mb-4">
                                        <div class="row">
                                            <div class="col">
                                                <label class="col-md-6 p-0">Họ và Tên</label>
                                                <div class="col-md-6 border-bottom p-0">
                                                    <input type="text" placeholder="Johnathan Doe" value="<?php echo $rowstudent['Name'] ?>"
                                                class="form-control p-0 border-0" name="example-name"> </div>
                                            </div>
                                            <div class="col">
                                            <label class="col-md-6 p-0">Tuổi</label>
                                                <div class="col-md-6 border-bottom p-0">
                                                    <input type="text" placeholder="Johnathan Doe" value="<?php echo  $diff->y ?>"
                                                class="form-control p-0 border-0" name="example-age"> </div>
                                            </div>
                                        </div>
            
                                    </div>
                                    <div class="form-group mb4">
                                        <label for="example-email" class="col-md-12 p-0">Ngày Sinh</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" placeholder="johnathan@admin.com" value="<?php echo $rowstudent['DoB'] ?>"
                                                class="form-control p-0 border-0" name="example-dob"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Email</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" placeholder="johnathan@admin.com" value="<?php echo $rowstudent18['Email'] ?>"
                                                class="form-control p-0 border-0" name="example-email"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0">Địa Chỉ</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" placeholder="johnathan@admin.com" value="<?php echo $rowstudent['Address'] ?>"
                                                class="form-control p-0 border-0" name="example-address"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Mật Khẩu</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="password" value="<?php echo $row['password'] ?>" class="form-control p-0 border-0">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Số Điện Thoại</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="123 456 7890"
                                                class="form-control p-0 border-0" value="<?php echo $rowstudent18['Phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Tin Nhắn</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <textarea rows="5" class="form-control p-0 border-0"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Cập Nhật Thông Tin</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            
            </div>
            
            <footer class="footer text-center"> 2021 © DataBase Of 08 <a
                    href="https://www.wrappixel.com/">hung.nguyenhung@hcmut.edu.vn</a>
            </footer>
        </div>  
    </div>
    
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
</body>

</html>