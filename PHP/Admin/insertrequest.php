<?php
    session_start();
    include('../db/ketnoi.php');
    if(isset($_POST["cid"], $_POST["sid"]))
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time = date("H:i:s");
        $cid = mysqli_real_escape_string($con, $_POST["cid"]);
        $sid = mysqli_real_escape_string($con, $_POST["sid"]);
        $sname = mysqli_real_escape_string($con, $_POST["sname"]);
        $content = mysqli_real_escape_string($con, $_POST["content"]);
        $ename = mysqli_real_escape_string($con, $_POST["ename"]);
        $timereceive = date("Y-m-d H:i:s");
        $query = mysqli_query($con,"INSERT INTO request (CID, StudentID, Time, Content, Status) 
        VALUES('$cid', '$sid','$time' ,'$content','Chưa chấp nhận')");
        
        if($query)
        {   
            $sqlrequest = mysqli_query($con,"SELECT * FROM request WHERE CID ='{$cid}' AND StudentID = '{$sid}' ");
            $rowrequest = mysqli_fetch_array($sqlrequest);

            $sql = mysqli_query($con,"INSERT INTO receive (SCID,RID,ReceivedTime) Values('{$_SESSION['unique_id']}',
            {$rowrequest['RID']},'$timereceive')");
            if($sql){
                echo 'Đã Tạo Yêu Cầu';
            }
            else{
                echo 'Vui Lòng Xem Xét Lại Thông Tin Của Cá Nhân';
            }
        }
        else{
            echo 'Vui Lòng Xem Xét Lại Thông Tin';
        }
    }
?>