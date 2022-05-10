<?php
    session_start();
    include('../db/ketnoi.php');
    if(isset($_POST["cid"], $_POST["studentid"]))
    {
        $cid = mysqli_real_escape_string($con, $_POST["cid"]);
        $studentid = mysqli_real_escape_string($con, $_POST["studentid"]);
        $name = mysqli_real_escape_string($con, $_POST["name"]);
        $mark = mysqli_real_escape_string($con, $_POST["mark"]);
        $comment = mysqli_real_escape_string($con, $_POST["comment"]);

        $query = mysqli_query($con,"INSERT INTO studentresult (CID, StudentID, Mark, Comment) 
        VALUES('$cid', '$studentid',$mark ,'$comment')");
        
        if($query)
        {   
            echo 'Đã Tạo Kết Quả';
        }
        else{
            echo 'Vui Lòng Xem Xét Lại Thông Tin';
        }
    }
?>