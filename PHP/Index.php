<?php
    session_start();
    include('./db/ketnoi.php');
    if(isset($_POST['idCourse'])){
        $idCourse =  $_POST['idCourse'];
        header('Location: include/course.php');
    }
    if(!isset($_SESSION['unique_id'])){
        header("location: Dangnhap.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <!-- <link rel="stylesheet" href="./Chatbox/style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <div class="inner-header">
            <a href="./index1.php">
                <img src="./img/Logo.png" alt="" class="logo">
            </a>
            <div class="search-bar">
                <div class="search-bar__title">
                    <h3>tìm kiếm</h3>
                    <h3>khóa học</h3>
                </div>
                <form action="" method="post" class = "find-input__container">
                    <input type="text" name="idCourse" class="find-input" placeholder="Tìm kiếm...">
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
                        <a href="./student/profile.php" class="item-link">Học viên</a>
                    </li>
                </ul>
                <?php 
                    $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                    if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                    }
                ?>
                <a href="./Chatbox/php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="login-header">
                    <i class="fas fa-user"></i>
                </a>
                <i class="fas menu-toggle fa-bars" aria-hidden="true"></i>
            </div>
        </div>
    </header>
    <section class="landing">
        <div class="landing-social">   
            <a href="https://www.facebook.com/hung0909">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/quoccchhunggg/">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.tiktok.com/@hung090901?lang=en">
                <i class="fab fa-tiktok"></i>
            </a>
        </div>
        <div class="landing-container">
            <img src="./img/landing.png" alt="" class="landing-img">
        </div>
        <div class="landing-footer">
            <div class="landing-footer__carousel">
                <div class="small-rectangle">
                </div>
                <div class="small-rectangle">
                </div>
                <div class="largest-rectangle">
                </div>
            </div>
            <div class="landing-footer__subheadline">
                <h3 class = "subheadline1">250,998</h3>
                <h3 class = "subheadline2">people are learning with us</h3>
            </div>
        </div>
    </section>
        <div class="footer-boxchat">
            <div class="wrapper" style="display:none">
                <section class="users">
                <header style="padding-bottom:20px; margin-bottom:0px;">
                    <div class="content">
                    <?php 
                        $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                        if(mysqli_num_rows($sql) > 0){
                            $row = mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <img src="./Chatbox/php/images/<?php echo $row['img']?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fullname'] ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                    </div>
                    <a href="./Chatbox/php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Đăng Xuất</a>
                </header>
                <div class="search">
                    <span class="text">Chọn người dùng để bắt đầu nhắn tin</span>
                    <input type="text" placeholder="Gõ tên để tìm kiếm...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">
            
                </div>
                </section>
            </div>
            <i class="fas fa-comments"></i>
        </div>


        <footer class="footer text-center"> 2021 © DataBase Of 08 <a
            href="https://www.wrappixel.com/" style="color:#337ab7;">database08@hcmut.edu.vn</a>
        </footer>
    <script src="./index.js"></script>
    <script src="./Chatbox/javascript/users.js"></script>
    <script>
        $(document).ready(function(){
            $(".fa-comments").click(function(){
                $(".wrapper").toggle(500);
            });
        });
    </script>
</body>
</html>