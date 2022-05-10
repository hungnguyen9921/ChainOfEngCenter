<?php
$username = "admin0"; // Khai báo username
$password = "654321";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "student_care";      // Khai báo database

// Kết nối database
$con = mysqli_connect($server, $username, $password, $dbname);
$customer = mysqli_connect($server,'customer','555555',$dbname);
$student = mysqli_connect($server,'student','123456',$dbname);
$teacher = mysqli_connect($server,'teacher','111111',$dbname);
$stdcare = mysqli_connect($server,'stdcare','222222',$dbname);
$bra_mng = mysqli_connect($server,'bra_mng','333333',$dbname);
$cou_mng = mysqli_connect($server,'cou_mng','444444',$dbname);

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if (!$con || !$customer || !$student || !$teacher || !$stdcare || !$bra_mng || !$cou_mng) {
    die("Không kết nối :" . mysqli_connect_error());
    exit();
}
   // echo "Kết nối thành công sẽ tiếp tục dòng code bên dưới đây."
?>