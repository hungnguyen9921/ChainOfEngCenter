<?php  
//action.php
    $connect = mysqli_connect('localhost', 'root', '', 'student_care');

    $input = filter_input_array(INPUT_POST);

    $studentid = mysqli_real_escape_string($connect, $input["StudentID"]);
    $mark = mysqli_real_escape_string($connect, $input["Mark"]);
    $comment = mysqli_real_escape_string($connect, $input["Comment"]);
    if($input["action"] === 'edit')
    {
        $query = "
        UPDATE studentresult  
        SET StudentID = '".$studentid."',
        Mark = '".$mark."',
        Comment = '".$comment."'
        WHERE CID = '".$input["id"]."'
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