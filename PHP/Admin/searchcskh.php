<?php
    session_start();
    include('../db/ketnoi.php');
    $find = $_POST['data'];
    $sqlsearch = mysqli_query($con,"SELECT * FROM student WHERE (Name LIKE '%{$find}%')");
    $output =""; 
    if(mysqli_num_rows($sqlsearch) > 0){
        $output .= '<table id="editable_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Họ và Tên</th>
                        <th>Địa Chỉ</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        </tr>
                    </thead>';
        while($rowsearch = mysqli_fetch_assoc($sqlsearch)){
            $output .='<tbody>
                    <tr>
                        <td>'.$rowsearch["ID"].'</td>
                        <td>'.$rowsearch["Name"].'</td>
                        <td>'.$rowsearch["Address"].'</td>
                        <td>'.$rowsearch["Sex"].'</td>
                        <td>'.$rowsearch["DoB"].'</td>
                    </tr>               
                    </tbody>';
        }
        echo $output;
    }
    else{
        echo 'Data Not Found';
    }
?>
<script>  
    $(document).ready(function(){
        $('#editable_table').Tabledit({
            url:'action.php',
            columns:{
            identifier:[0, "id"],
            editable:[[1, 'name'], [2, 'address'], [3, 'sex'], [4, 'dob']]
        },
        restoreButton:false,
        onSuccess:function(data, textStatus, jqXHR)
        {
            if(data.action == 'delete')
            {
                $('#'+data.id).remove();
            }
        }
        });
    });
</script>