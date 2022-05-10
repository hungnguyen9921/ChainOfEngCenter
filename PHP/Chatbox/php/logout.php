<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include('../../db/ketnoi.php');
        $logout_id = mysqli_real_escape_string($con, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Không hoạt động";
            $sql = mysqli_query($con, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../../Dangnhap.php");
            }
        }else{
            header("location: ../../Dangky.php");
        }
    }else{  
        header("location: ../../Dangnhap.php");
    }
?>