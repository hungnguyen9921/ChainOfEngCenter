<?php
    session_start();
    include('./db/ketnoi.php');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">    
    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" href="Favicon.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Đăng ký</title>
</head>
<body>
<style>
    body {
        background-image: url(./img/Background.png);
        color: #000;
        overflow-x: hidden;
        height: 100%;
        background-color: #B0BEC5;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="index1.php">Trang chủ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        <div class="cotainer py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card0 border-0" style="box-shadow: 0px 4px 8px 0px #757575;">
                        <div class="card-header">Đăng ký</div>
                        <div class="card-body">
                            <form action="" method="POST">
                            <div class="error-text">

                            </div>
                            <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Tên tài khoản</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" class="form-control" name="fullname" required >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Tài Khoản Email</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Ngày Sinh</label>
                                    <div class="col-md-6">
                                        <input type="text" id="dob" class="form-control" name="dob" required >
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Số điện thoại</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone" class="form-control" name="phone" required >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Địa Chỉ</label>
                                    <div class="col-md-6">
                                        <input type="text" id="address" class="form-control" name="address" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Chọn Hình Ảnh</label>
                                    <div class="col-md-6">
                                        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Mật Khẩu</label>
                                    <div class="col-md-6 field-password">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                        <i class="fas fa-eye hiddenpw"></i>
                                    </div>
                                </div>


                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" name="dangky" class="btn btn-primary signup">
                                       Đăng ký
                                    </button>
                                    <a href="Dangnhap.php" class="btn btn-link">
                                       Đã có tài khoản ?
                                    </a>
                                </div>
                        </div>
                        </form>
                        <div class="bg-blue py-4" style="background-color: #1A237E; border-radius: 0.25rem;">
                            <div class="row px-3" style="color: #fff;"> <small class="ml-4 ml-sm-5 mb-2">DataBase © 2021.Trung Tâm Tiếng Anh.</small>
                            <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="./Chatbox/javascript/signup.js"></script>>
<script>
    const toggle = document.querySelector('.navbar-toggler-icon');
    const info = document.querySelector('.collapse');
    toggle.addEventListener('click',function(e){
        if(info.style.display == "none"){
            info.style.display = "block";
        }
        else{
            info.style.display = "none";
        }
    });
    const pswrdField = document.querySelector(".col-md-6 input[type='password']");
    const showpass = document.querySelector('.hiddenpw');
    showpass.addEventListener('click', function(){
        if(pswrdField.type === "password"){
            pswrdField.type = "text";
            showpass.classList.add("active");
        }else{
            pswrdField.type = "password";
            showpass.classList.remove("active");
        }
    });
</script>

</body>
</html>
    