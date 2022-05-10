<?php
    session_start();
        include('../db/ketnoi.php');
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $rate = mysqli_real_escape_string($con, $_POST['message']);
        $sqlstudent = mysqli_query($con,"SELECT * from student_from_18 WHERE Email='{$email}'");
        $sqlguardian = mysqli_query($con,"SELECT * from guardian WHERE Email='{$email}'");
        if($name != "" && $email != "" && $rate != ""){
            if(mysqli_num_rows($sqlstudent) > 0 || mysqli_num_rows($sqlguardian) > 0){
                if(mysqli_num_rows($sqlstudent) > 0){
                    $sqlstudent = mysqli_query($con, "SELECT * FROM learn WHERE StudentID = '{$_SESSION['unique_id']}'");
                    $rowstudent = mysqli_fetch_assoc($sqlstudent);
                    $sqlrate = mysqli_query($con, "SELECT * FROM ratecourse WHERE StudentID = '{$_SESSION['unique_id']}'");
                    $sqlinsert = mysqli_query($con, "INSERT INTO ratecourse (CID, StudentID, Rate) 
                    VALUES ('{$rowstudent['CID']}' ,'{$_SESSION['unique_id']}','$rate')");
                    if($sqlinsert){
                        echo "success";
                    }
                    else{
                        if(mysqli_num_rows($sqlrate) > 0){
                            echo "Bạn đã đánh giá khóa học";
                        }
                        else{
                            echo "Vui lòng coi lại thông tin bạn đã nhập";
                        }
                    }
                }
                else{
                    $sqlstudent = mysqli_query($con, "SELECT * FROM learn WHERE StudentID = '{$_SESSION['unique_id']}'");
                    $rowstudent = mysqli_fetch_assoc($sqlstudent);
                    $sqlinsert = mysqli_query($con, "INSERT INTO ratecourse(CID, StudentID, Rate) 
                    values ('{$rowstudent['CID']}')' ,'{$_SESSION['unique_id']}','{$name}'");
                    if($sqlinsert){
                        echo "success";
                    }
                    else{
                        echo "Vui lòng coi lại thông tin bạn đã nhập";
                    }
                }
            }
            else{
                echo "Vui lòng nhập đúng email";
            }
        }
        else{
            echo "Vui lòng điền đầy đủ thông tin";
        }
?>