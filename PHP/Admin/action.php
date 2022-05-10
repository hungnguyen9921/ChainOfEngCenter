<?php  
//action.php
    $connect = mysqli_connect('localhost', 'root', '', 'student_care');

    $input = filter_input_array(INPUT_POST);

    $name = mysqli_real_escape_string($connect, $input["name"]);
    $address = mysqli_real_escape_string($connect, $input["address"]);
    $sex = mysqli_real_escape_string($connect, $input["sex"]);
    $dob = mysqli_real_escape_string($connect, $input["dob"]);
    if($input["action"] === 'edit')
    {
        $query = "
        UPDATE student 
        SET Name = '".$name."', 
        Address = '".$address."',
        Sex = '".$sex."',
        DoB = '".$dob."'
        WHERE id = '".$input["id"]."'
        ";

        mysqli_query($connect, $query);

    }
    if($input["action"] === 'delete')
    {
        $query = "
        DELETE FROM student 
        WHERE id = '".$input["id"]."'
        ";
        mysqli_query($connect, $query);
    }

    echo json_encode($input);

?>