<?php
    session_start();
    include('../db/ketnoi.php');
    $sqlteacher = mysqli_query($con,"SELECT* FROM teacher WHERE ID ='{$_SESSION['unique_id']}'");
    if(mysqli_num_rows($sqlteacher)<=0){
        $message = "Bạn Không thể truy cập vào trang này vui lòng xem lại";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='admintotal.php';
        </script>";
    }
    $query = "SELECT * FROM studentresult WHERE CID IN(SELECT CID FROM teach
            WHERE TID = '{$_SESSION['unique_id']}')";
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="../jquery-tabledit-1.2.3/jquery-tabledit-1.2.3/jquery.tabledit.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Hoc viên</title>
</head>
<body>
    <?php
        include('./navbar.php');
    ?>
    <div id="Used">
    <div class="container">
        <div class="search-contain" style="display:flex; justify-content: flex-end;align-items: center;">
            <p style="display:flex;color: #fff; margin-bottom:0px; align-content: center;">Search:</p>
            <div class="search-people" style="padding:0px 10px;">
                <input type="search" class="form-control input-sm" placeholder="" aria-controls="user_data">
            </div>
            <button type="button" name="add" id="add" class="btn btn-info">Thêm</button>
        </div>
        <div class="row" style="background-color: #fff">
            <div class="col-md-3 pl-1"style="background-color: #fff">
                <div class="list-group ">
                    <a href="./admintotal.php" class="list-group-item list-group-item-action">Thông tin</a>
                    <a href="./cskh.php" class="list-group-item list-group-item-action">Nhân viên CSKH</a>
                    <a href="./teacher.php"  class="list-group-item list-group-item-action">Giảng viên</a>
                    <a href="./student.php" class="list-group-item list-group-item-action">Học viên</a>
                    <a href="./mainadmin.php"  class="list-group-item list-group-item-action">Quản lí chi nhánh</a>
                    <a href="./admincourse.php"  class="list-group-item list-group-item-action">Quản lí khóa học</a>
                    <a href="./results.php"  class="list-group-item list-group-item-action active">Kết quả học tập</a>
                    <a href="./course.php" class="list-group-item list-group-item-action">Khóa học</a>
                    <a href="./request.php" class="list-group-item list-group-item-action">Yêu Cầu</a>
                    <a href="./createrequest.php" class="list-group-item list-group-item-action">Tạo Yêu Cầu</a>
                    <a href="./createtime.php" class="list-group-item list-group-item-action">Lịch Học</a>
                    <a href="./requestcourse.php" class="list-group-item list-group-item-action">Hủy Khóa Học</a>
                    <a href="./rate.php" class="list-group-item list-group-item-action">Đánh giá</a>
                </div> 
            </div>
            <div class="col-md-9" style="background-color: #fff;">
                <div class="card">
                <div id="alert_message"></div>
                    <div class="card-body">
                        <div class="contain-admin__table" style="overflow: scroll; height:686px;">
                            <table id="editable_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>ID Khóa Học</th>
                                    <th>Student ID</th>
                                    <th>Họ và Tên</th>
                                    <th>Điểm</th>
                                    <th>Đánh Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $sqlresult = mysqli_query($con, "SELECT * FROM student 
                                            WHERE ID = '{$row['StudentID']}'");
                                            $rowresult = mysqli_fetch_array($sqlresult);
                                            echo '
                                            <tr>
                                            <td>'.$row["CID"].'</td>
                                            <td>'.$row["StudentID"].'</td>
                                            <td>'.$rowresult["Name"].'</td>
                                            <td>'.$row["Mark"].'</td>
                                            <td>'.$row["Comment"].'</td>
                                            </tr>
                                            ';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<script>
     $(document).ready(function(){
        fetch_data();

        function fetch_data()
        {
        var dataTable = $('#user_data').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
            url:"fetch.php",
            type:"POST"
            }
        });
        }
        $('#editable_table').Tabledit({
            url:'actionresults.php',
            columns:{
            identifier:[0, "id"],
            editable:[[1, 'StudentID'], [2, 'Name'], [3, 'Mark'], [4, 'Comment']]
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
        $('.input-sm').keyup(function(){
        var text = $('.input-sm').val();
        $.post('search.php', {data : text}, function(data){
            $('.contain-admin__table').html(data);
        })
        });

        $('#add').click(function(){
            var html = '<tr>';
            html += '<td contenteditable id="data1"></td>';
            html += '<td contenteditable id="data2"></td>';
            html += '<td contenteditable id="data3"></td>';
            html += '<td contenteditable id="data4"></td>';
            html += '<td contenteditable id="data5"></td>';
            html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
            html += '</tr>';
            $('#editable_table tbody').prepend(html);
        });

        $(document).on('click', '#insert', function(){
            var cid = $('#data1').text();
            var studentid = $('#data2').text();
            var name = $('#data3').text();
            var mark = $('#data4').text();

            var comment = $('#data5').text();
            if(cid != '' && studentid != '' && name != '' && mark != '' && comment != '')
            {

                if (cid.length != 15  || studentid.length != 7) {

                    alert("Kiểm tra lại thông số bạn nhập..")
                } 
                else {
                $.ajax({
                        url:"insertresult.php",
                        method:"POST",
                        data:{cid:cid, studentid:studentid, name:name, mark:mark, comment:comment},
                        success:function(data)
                        {
                            $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                            $('#editable_table').DataTable().destroy();
                            fetch_data();
                        }
                    
                    });
                    setInterval(function(){
                        $('#alert_message').html('');
                        var insert = document.getElementById('insert');
                        insert.parentNode.removeChild(insert);
                    }, 5000);
                }
            }
            else
            {
                alert("Vui Lòng Nhập Đầy Đủ Thông Tin");
            }
        });
     }); 
</script>
</body>
</html>