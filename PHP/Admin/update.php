<?php
    session_start();
    include('../db/ketnoi.php');
    if(isset($_POST["submit"]))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $ngaysinh = $_POST['ngaysinh'];
        $gioitinh = $_POST['gioitinh'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $query = " UPDATE employee SET ".$_POST["ngaysinh"]."='".$ngaysinh."' WHERE EID = '".$_POST["id"]."' ";
        $sqlupdate = mysqli_query($con, "UPDATE employee SET DoB = '".$ngaysinh."', ID = '".$id."' WHERE EID = '".$id."'") ;
        if($sqlupdate){
            $_SESSION['mess'] = 'Data is Update';
        }
        header("location: admintotal.php");   
    }
?>
