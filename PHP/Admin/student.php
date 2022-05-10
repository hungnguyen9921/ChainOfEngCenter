<?php
    session_start();
    include('../db/ketnoi.php');
    $query = "SELECT * FROM student ORDER BY ID DESC";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <div class="row">
            <div class="col-md-3 pl-1"style="background-color: #fff">
                <div class="list-group ">
                    <a href="./admintotal.php" class="list-group-item list-group-item-action">Thông tin</a>
                    <a href="./cskh.php" class="list-group-item list-group-item-action">Nhân viên CSKH</a>
                    <a href="./teacher.php"  class="list-group-item list-group-item-action">Giảng viên</a>
                    <a href="./student.php" class="list-group-item list-group-item-action active">Học viên</a>
                    <a href="./mainadmin.php"  class="list-group-item list-group-item-action">Quản lí chi nhánh</a>
                    <a href="./admincourse.php"  class="list-group-item list-group-item-action">Quản lí khóa học</a>
                    <a href="./results.php"  class="list-group-item list-group-item-action">Kết quả học tập</a>
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
                    <div class="card-body">
                        <div class="contain-admin__table" style="overflow: scroll; height:686px;">
                            <table id="editable_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>Họ và Tên</th>
                                    <th>Địa Chỉ</th>
                                    <th>Giới Tính</th>
                                    <th>Ngày Sinh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo '
                                        <tr>
                                        <td>'.$row["ID"].'</td>
                                        <td>'.$row["Name"].'</td>
                                        <td>'.$row["Address"].'</td>
                                        <td>'.$row["Sex"].'</td>
                                        <td>'.$row["DoB"].'</td>
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
        $('.input-sm').keyup(function(){
            var text = $('.input-sm').val();
            $.post('searchstudent.php', {data : text}, function(data){
                $('.contain-admin__table').html(data);
            })
        });
          
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
                console.log(1);
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
        
        const toggle = document.querySelector('.navbar-toggler-icon');
        const info = document.querySelector('.collapse');
        toggle.addEventListener('click',function(e){
            if(info.style.display == "none"){
                info.style.display = "block";
            }
            else{
                info.style.display = "none";
            }
        });
    });
 </script>
</body>
</html>