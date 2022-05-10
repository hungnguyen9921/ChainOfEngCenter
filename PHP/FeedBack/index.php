<?php
    session_start();
    include('../db/ketnoi.php');
?>
<?php
	if(isset($_POST['sendfeedback']))
	{
		echo 1;
	}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<title>FeedBack</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" href="../index.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<header style="margin-bottom: 0px">
        <div class="inner-header">
            <a href="../index1.php">
                <img src="../img/Logo.png" alt="" class="logo">
            </a>
            <div class="search-bar">
                <div class="search-bar__title">
                    <h3>search</h3>
                    <h3>anything</h3>
                </div>
                <form action="" method="post" class = "find-input__container">
                    <input type="text" name="idCourse" class="find-input" placeholder="Enter ID of Course">
                    <button type="submit" class= "button-search">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="navbar-icon">
                <ul class="main-menu">
                    <li>
                        <a href="./admin/admintotal.php" class="item-link">Nhân viên</a>
                    </li>
                    <li>
                        <a href="" class="item-link">Giáo viên</a>
                    </li>
                    <li>
                        <a href="" class="item-link">Thời khóa biểu</a>
                    </li>
                    <li>
                        <a href="./include/khoahoc.php" class="item-link">Khóa học</a>
                    </li>
                    <li>
                        <a href="./include/hocvien.php" class="item-link">Học viên</a>
                    </li>
                </ul>
                <a href="../Dangnhap.php" class="login-header">
                    <i class="fas fa-user"></i>
                </a>
                <i class="fas menu-toggle fa-bars" aria-hidden="true"></i>
            </div>
        </div>
    </header>

	<div class="bg-contact100" style="background-image: url('../img/Background.png');">
		<div class="container-contact100">
			<div class="wrap-contact100">
				<div class="contact100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>
				<form class="contact100-form validate-form" action="" method="post">
					<span class="contact100-form-title">
						Đánh giá của bạn về khóa học
					</span>
					<div class="error-text"></div>
					<div class="wrap-input100 validate-input" data-validate = "Name is required">
						<input class="input100" type="text" name="name" placeholder="Họ và Tên">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Địa chỉ Email của Bạn">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Message is required">
						<textarea class="input100" name="message" placeholder="Đánh giá"></textarea>
						<span class="focus-input100"></span>
					</div>
					<div class="container-contact100-form-btn">
						<button class="contact100-form-btn getfeedback" name ="sendfeedback">
							Gửi Đánh Giá
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script src="js/send.js"></script>
</body>
</html>
