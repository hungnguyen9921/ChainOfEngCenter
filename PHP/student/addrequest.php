<?php
    session_start();
    include('../db/ketnoi.php');
    if(isset($_POST['addrequest'])){
        $message ='';
        $idcourse = $_POST['idcourse'];
        $idstudent = $_POST['idstudent'];
        $namestudent = $_POST['namestudent'];
        $content = $_POST['content'];
        $message .= 'ID Khóa Học:'.$idcourse.' ';
        $message .= 'ID Học Viên:'.$idstudent.' ';
        $message .= 'Nội Dung:'.$content.' ';
        $idstudent = (int)$idstudent;
        $sqldelete =  $sql = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
        VALUES (4455667, {$idstudent}, '{$message}')") or die();
        if($sqldelete){
            echo '<script> alert("Data Deleted");</script>';
            header("Location: request.php");
        }
        else{
            echo '<script> alert("Data Not Deleted");</script>';
        }
    }
?>