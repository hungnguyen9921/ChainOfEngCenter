<?php
    session_start();
    include('./db/ketnoi.php');
    ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="Dangnhap.css">
    <link rel="icon" href="Favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>
    <title>Đăng nhập</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="index1.php">Trang chủ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Dangnhap.php">Đăng nhập</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Dangky.php">Đăng ký</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main class="login-form">
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row"> <img src="https://i.imgur.com/CXQmsmF.png" class="logo"> </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="https://i.imgur.com/uNGdWHi.png" class="image"> </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="" method="POST">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3">
                            <h6 class="mb-0 mr-4 mt-2">Đăng Nhập Với</h6>
                            <div class="facebook text-center mr-3">
                                <div class="fa fa-facebook"></div>
                            </div>
                            <div class="twitter text-center mr-3">
                                <div class="fa fa-twitter"></div>
                            </div>
                            <div class="linkedin text-center mr-3">
                                <div class="fa fa-linkedin"></div>
                            </div>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="line"></div> <small class="or text-center">Or</small>
                            <div class="line"></div>
                        </div>
                        <div class="error-text"></div>
                        <div class="row px-3"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Tài Khoản Email</h6>
                            </label> <input class="mb-4" type="text" name="email" placeholder="Enter a valid email address"> </div>
                        <div class="row px-3 field-login"> <label class="mb-1">
                                <h6 class="mb-0 text-sm">Mật Khẩu</h6>
                            </label> <input type="password" name="password" placeholder="Enter password"> 
                            <i class="fas fa-eye hiddenpw"></i>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Nhớ Mật Khẩu</label> </div> <a href="#" class="ml-auto mb-0 text-sm">Quên Mật Khẩu?</a>
                        </div>
                        <div class="row mb-3 px-3"> 
                            <button type="submit" name="dangnhap_home" class="btn btn-blue text-center">Đăng Nhập</button> 
                        </div>
                        <div class="row mb-4 px-3"> 
                            <small class="font-weight-bold">Bạn đã có tài khoản? 
                                <a class="text-danger " href="Dangky.php">Đăng ký</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">DataBase &copy; 2021.Trung Tâm Tiếng Anh.</small>
                    <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    const toggle = document.querySelector('.navbar-toggler-icon');
    const info = document.querySelector('.navbar-collapse')
    toggle.addEventListener('click',function(e){
        info.classList.toggle('in');
    });
</script>
<script src="./Chatbox/javascript/pass-show-hide.js"></script>
<script src="./Chatbox/javascript/login.js"></script>
</body>
</html>