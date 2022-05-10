<?php
    session_start();
    include('../db/ketnoi.php');
    if(isset($_POST['deletedata'])){
        $id = $_POST['delete_id'];
        $sqldelete =  mysqli_query($con, "DELETE  FROM request WHERE RID = '{$id}'");
        if($sqldelete){
            echo '<script> alert("Data Deleted");</script>';
            header("Location: request.php");
        }
        else{
            echo '<script> alert("Data Not Deleted");</script>';
        }
    }
?>