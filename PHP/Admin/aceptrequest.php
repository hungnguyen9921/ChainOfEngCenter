<?php
    session_start();
    include('../db/ketnoi.php');
    if(isset($_POST['aceptdata'])){
        $id = $_POST['acept_id'];
        $sqlacpt =  mysqli_query($con, "UPDATE request SET Status ='Chấp nhận' WHERE RID = '{$id}'");
        $sqlreceive = mysqli_query($con, "SELECT* FROM receive WHERE RID ='{$id}'");
        $rowreceive = mysqli_fetch_assoc($sqlreceive);
        $sqlstudent = mysqli_query($con, "SELECT * FROM request WHERE RID = '$id'");
        $rowstudent = mysqli_fetch_assoc($sqlstudent);
        $student_care = $rowreceive['SCID'];
        $student_care = (int)$student_care;
        $rowstid = $rowstudent['StudentID'];
        $rowstid = (int)$rowstid;
        if($sqlacpt){
            $sql = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES ({$rowstid}, {$student_care}, 'Yêu cầu của bạn đã được xem xét vui lòng kiểm tra
            thông tin trong vài ngày')");
            if($sql){
                header("Location: request.php");
            }
            else{
                $mess = mysqli_errno($con);
                echo "<script type='text/javascript'>alert('$mess');
                 </script>";
            }
        }
        else{
            echo '<script> alert("Vui lòng kiểm tra lại");</script>';
        }
    }
?>