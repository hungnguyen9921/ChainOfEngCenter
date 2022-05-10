<?php
    session_start();
    include('../db/ketnoi.php');
    if(isset($_POST["idcourse"])){
        $idcourse = $_POST["idcourse"];
        $sql = mysqli_query($con, "INSERT into learn (CID, StudentID, TuitionStatus)
        values ('{$idcourse}','{$_SESSION['unique_id']}',0)");
        $result = array(
            'response' => array(
              'status' => 'error',
              'code' => '1', // whatever you want
              'message' => 'Could not connect to the database.'
            )
          ); 
        if($sql){
            $result = array(
                'response' => array(
                  'status' => 'success',
                  'code' => '1', // whatever you want
                  'message' => 'Could not connect to the database.'
                )
              ); 
        }
        else{
            $result = array(
                'response' => array(
                  'status' => 'error',
                  'code' => '1', // whatever you want
                  'message' => 'Could not connect to the database.'
                )
              ); 
            
        }
    }
    echo json_encode($result);
?>
