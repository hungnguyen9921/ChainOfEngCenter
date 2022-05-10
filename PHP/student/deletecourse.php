<?php
    session_start();
    include('../db/ketnoi.php');
    if(isset($_POST['deletedata'])){
        $id = $_POST['delete_id'];
        $sqldelete =  mysqli_query($con, "DELETE FROM learn WHERE StudentID = '{$_SESSION['unique_id']}' AND CID = '{$id}'");
        if($sqldelete){
            echo '<script> alert("Data Deleted");</script>';
            header("Location: allcourse.php");
        }
        else{
            echo '<script> alert("Data Not Deleted");</script>';
        }
    }
?>