<?php  
//action.php
    $connect = mysqli_connect('localhost', 'root', '', 'student_care');

    $input = filter_input_array(INPUT_POST);

    $tid = mysqli_real_escape_string($connect, $input["tid"]);
    $ctime = mysqli_real_escape_string($connect, $input["ctime"]);
    $date = mysqli_real_escape_string($connect, $input["date"]);
    if($input["action"] === 'edit')
    {
        $query = "
        UPDATE course 
        SET CTime = '".$ctime."' 
        WHERE CID = '".$input["id"]."'
        ";
        $sql = "
        UPDATE learningdate
        SET Date ='".$date."'
        WHERE CID = '".$input["id"]."'
        ";

        mysqli_query($connect, $query);
        mysqli_query($connect, $sql);
    }

    echo json_encode($input);

?>