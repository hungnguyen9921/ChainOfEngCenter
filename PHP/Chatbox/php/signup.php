<?php
    session_start();
    include('../../db/ketnoi.php');
    function checkmydate($date) {
        $tempDate = explode('-', $date);
        // checkdate(month, day, year)
        return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
    }
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    if(!empty($fullname) && !empty($email) && !empty($password) && !empty($dob) && !empty($address) && !empty($phone)){
        if(!checkmydate($dob)){
            echo "Vui lòng nhập ngày sinh theo yyyy-mm-dd";
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - Email này đã tồn tại!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                                $ran_id = rand(1000000,9999999);
                                $status = "Đang hoạt động";
                                $encrypt_pass = md5($password);
                                $insert_query = mysqli_query($con, "INSERT INTO users (unique_id, fullname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fullname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                                if($insert_query){
                                    $select_sql2 = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        $sql = mysqli_query($con,"INSERT into Student(ID, Name, Address, DoB)
                                        Values('$ran_id','$fullname','$address','$dob') ");
                                        if($sql){
                                            echo "success";
                                        }
                                        else{
                                            echo "Làm ơn hãy thử lại";
                                        }
                                        
                                    }else{
                                        echo "Email không tồn tại!";
                                    }
                                }else{
                                    echo "Làm ơn thử lại!";
                                }
                            }
                        }else{
                            echo "Hãy Upload file với định dạnh file - jpeg, png, jpg";
                        }
                    }else{
                        echo "Hãy Upload file hình ảnh - jpeg, png, jpg";
                    }
                }
            }
        }else{
            echo "$email không phải là một Email!";
        }
    }else{
        echo "Vui lòng nhập tập cả các dòng!";
    }
?>