<?php
    session_start();
    include('../db/ketnoi.php');
    $admintotal = true;
    $sqladmin = mysqli_query($con, "SELECT * FROM employee where EID = '{$_SESSION['unique_id']}' ");
    if(mysqli_num_rows($sqladmin) > 0){
        $rowadmin = mysqli_fetch_assoc($sqladmin);
    }
    else{
        $message = "Bạn Không thể truy cập vào trang này vui lòng xem lại";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='../index1.php';
        </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<!------ Include the above in your HEAD tag ---------->
<style>
    body {
        background-image: url(../img/Background.png);
        color: #000;
        overflow-x: hidden;
        height: 100%;
        background-color: #B0BEC5;
    }
</style>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-laravel" style="margin-bottom:40px; padding-top:30px">
        <div class="container">
            <a class="navbar-brand" href="../index1.php">Trang chủ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Dangnhap.php">Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Dangky.php">Đăng ký</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-3 "style="background-color: #fff;">
                <div class="list-group ">
                    <a href="./admintotal.php" class="list-group-item list-group-item-action active">Thông tin</a>
                    <a href="./cskh.php" class="list-group-item list-group-item-action">Nhân viên CSKH</a>
                    <a href="./teacher.php"  class="list-group-item list-group-item-action">Giảng viên</a>
                    <a href="./student.php" class="list-group-item list-group-item-action">Học viên</a>
                    <a href="./mainadmin.php"  class="list-group-item list-group-item-action">Quản lí chi nhánh</a>
                    <a href="./admincourse.php"  class="list-group-item list-group-item-action">Quản lí khóa học</a>
                    <a href="./results.php"  class="list-group-item list-group-item-action">Kết quả học tập</a>
                    <a href="./course.php" class="list-group-item list-group-item-action">Khóa học</a>
                    <a href="./request.php" class="list-group-item list-group-item-action">Yêu Cầu</a>
                    <a href="./createrequest.php" class="list-group-item list-group-item-action">Tạo Yêu Cầu</a>
                    <a href="./createtime.php" class="list-group-item list-group-item-action">Lịch Học</a>
                    <a href="./requestcourse.php" class="list-group-item list-group-item-action">Hủy Khóa Học</a>
                    <a href="./rate.php" class="list-group-item list-group-item-action">Đánh giá</a>
                </div> 
            </div>
            <div class="col-md-9" style="background-color: #fff;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Thông Tin Nhân Viên</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="update.php">
                                <div class="form-group row">
                                    <label for="id" class="col-4 col-form-label">ID*</label> 
                                    <div class="col-8">
                                    <input id="id" value="<?php echo $rowadmin['EID'] ?>" name="id" placeholder="ID" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Họ và Tên</label> 
                                    <div class="col-8">
                                    <input id="name" value="<?php echo $rowadmin['Name'] ?>"  name="name" placeholder="Họ và tên" class="form-control here" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ngaysinh" class="col-4 col-form-label">Ngày sinh</label> 
                                    <div class="col-8">
                                    <input id="ngaysinh" value="<?php echo $rowadmin['DoB'] ?>" name="ngaysinh" placeholder="Ngày sinh" class="form-control here" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gioitinh" class="col-4 col-form-label">Giới tính</label> 
                                    <div class="col-8">
                                    <input id="gioitinh" value="<?php echo $rowadmin['Sex'] ?>" name="gioitinh" placeholder="Giới tính" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="select" class="col-4 col-form-label">Chức vụ</label> 
                                    <div class="col-8">
                                    <input id="chucvu" value="<?php echo $rowadmin['Job'] ?>" name="chucvu" placeholder="Chức vụ" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email*</label> 
                                    <div class="col-8">
                                    <input id="email" value="<?php echo $rowadmin['Email'] ?>" name="email" placeholder="Email" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-4 col-form-label">Số điện thoại</label> 
                                    <div class="col-8">
                                    <input id="phone" value="<?php echo $rowadmin['Phone'] ?>" name="phone" placeholder="Số điện thoại" class="form-control here"  type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="curentpass" class="col-4 col-form-label">Mật khẩu*</label> 
                                    <div class="col-8">
                                    <input id="curentpass" name="curentpass" placeholder="Mật khẩu hiện tại" class="form-control here" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newpass" class="col-4 col-form-label">Mật khẩu mới*</label> 
                                    <div class="col-8">
                                    <input id="newpass" name="newpass" placeholder="Mật khẩu mới" class="form-control here" type="text">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                                        <button name="logout" onclick="<?php $_SESSION['admintotal'] = false ?>" type="submit" class="btn btn-primary" style="background-color: red; border : 0;">
                                            <a href="../Chatbox/php/logout.php?logout_id=<?php echo $rowadmin['EID']; ?>" class="admin-logout" style="color: #fff;">Đăng xuất</a>
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        
        window.addEventListener("load", function(e){
            const logout = querySelector()
        });
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
    </script>
</body>
</html>