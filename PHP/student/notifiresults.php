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
        $sqlteaching = mysqli_query($con, "SELECT * FROM teach WHERE CID = '{$rowcourse['CID']}'");
        $rowteaching = mysqli_fetch_assoc($sqlteaching);
        $sqlteacher = mysqli_query($con, "SELECT * FROM employee WHERE EID = '{$rowteaching['TID']}'");
        $rowteacher =  mysqli_fetch_assoc($sqlteacher);

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
    <meta name="robots" content="noindex,nofollow">
    <title>Results Of Course</title>
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
                                <input type="text" placeholder="Tìm Kiếm" class="form-control mt-0">
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
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
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
                                <span class="hide-menu">Khóa Học</span>
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
                                <span class="hide-menu">Yêu Cầu Học Viên</span>
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
                        <h4 class="page-title">Kết Quả Của Học Viên</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="#" class="fw-normal">Trang Chủ</a></li>
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
            <?php
                $sqlresult = mysqli_query($con,"SELECT * FROM studentresult WHERE CID='{$rowcourse['CID']}'
                AND StudentID = '{$_SESSION['unique_id']}' ");
                $rowresult = mysqli_fetch_assoc($sqlresult);
            ?>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Kết Quả</h3>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">ID Khóa Học</th>
                                            <th class="border-top-0">ID Học Viên</th>
                                            <th class="border-top-0">Họ và Tên</th>
                                            <th class="border-top-0">Giáo Viên Đánh Giá</th>
                                            <th class="border-top-0">Điểm</th>
                                            <th class="border-top-0">Đánh Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><?php echo $rowcourse['CID']?></td>
                                            <td><?php echo $rowstudent['ID'] ?></td>
                                            <td><?php echo $rowstudent['Name']?></td>
                                            <td><?php echo $rowteacher['Name']?></td>
                                            <td><?php echo $rowresult['Mark']?></td>
                                            <td><?php echo $rowresult['Comment']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <footer class="footer text-center"> 2021 © DataBase Of 08 <a
                    href="https://www.wrappixel.com/">hung.nguyenhung@hcmut.edu.vn</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
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