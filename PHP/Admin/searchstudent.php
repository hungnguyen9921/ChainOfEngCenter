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
        $('#add').click(function(){
            var html = '<tr>';
            html += '<td contenteditable id="data1"></td>';
            html += '<td contenteditable id="data2"></td>';
            html += '<td contenteditable id="data3"></td>';
            html += '<td contenteditable id="data4"></td>';
            html += '<td contenteditable id="data5"></td>';
            html += '<td contenteditable id="data6"></td>';
            html += '<td contenteditable id="data7"></td>';
            html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
            html += '</tr>';
            $('#editable_table tbody').prepend(html);
        });

        $(document).on('click', '#insert', function(){
            var cid = $('#data1').text();
            var sid = $('#data2').text();
            var sname = $('#data3').text();

            var time = $('#data4').text();
            var content = $('#data5').text();
            var eid = $('#data6').text();
            var ename = $('#data6').text();
            if(cid != '' && sid != '' && sname != '' && time != '' && content != '' && eid != '' && ename != '')
            {

                if (cid.length != 15  || sid.length != 7) {

                    alert("Check your enterd details..")
                } 
                else {
                $.ajax({
                        url:"insertrequest.php",
                        method:"POST",
                        data:{cid:cid, sid:sid, sname:sname, time:time, content:content, eid:eid, ename:ename},
                        success:function(data)
                        {
                        $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                        $('#user_data').DataTable().destroy();
                        fetch_data();
                        }
                    });
                    setInterval(function(){
                        $('#editable_table').html('');
                    }, 5000);
                }
            }
            else
            {
                alert("All Fields required");
            }
        });
    });
</script>