<?php
    session_start();
    include('../db/ketnoi.php');
    $query = "SELECT * FROM employee WHERE Job ='Chăm sóc khách hàng' ORDER BY EID DESC";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        <div class="row" style="background-color: #fff; border-radius:20px;" >
            <div class="col-md-3 pl-1"style="background-color: #fff">
                <div class="list-group ">
                    <a href="./admintotal.php" class="list-group-item list-group-item-action">Thông tin</a>
                    <a href="./cskh.php" class="list-group-item list-group-item-action active">Nhân viên CSKH</a>
                    <a href="./teacher.php"  class="list-group-item list-group-item-action">Giảng viên</a>
                    <a href="./student.php" class="list-group-item list-group-item-action">Học viên</a>
                    <a href="./mainadmin.php"  class="list-group-item list-group-item-action">Quản lí chi nhánh</a>
                    <a href="./admincourse.php"  class="list-group-item list-group-item-action">Quản lí khóa học</a>
                    <a href="./results.php"  class="list-group-item list-group-item-action">Kết quả học tập</a>
                    <a href="./course.php" class="list-group-item list-group-item-action">Khóa học</a>
                    <a href="./request.php" class="list-group-item list-group-item-action">Yêu Cầu</a>
                    <a href="./createrequest.php" class="list-group-item list-group-item-action">Tạo Yêu Cầu</a>
                    <a href="./createtime.php" class="list-group-item list-group-item-action">Lịch Học</a>
                    <a href="./requestcourse.php" class="list-group-item list-group-item-action">Báo Cáo</a>
                    <a href="./rate.php" class="list-group-item list-group-item-action">Đánh giá</a>
                </div> 
            </div>
            <div class="col-md-9" style="background-color: #fff; ">
                <div class="card" style="justify-content: center;">
                    <div class="card-body" style="justify-content: center;">
                        <div class="contain-admin__table" style="overflow: scroll; height:686px; border-radius:10px;">
                            <table id="editable_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="row100 head" style="line-height:1.4px; background-color:#6c7ae0; color:#fff">
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
                                            <td>'.$row["EID"].'</td>
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
        $('#editable_table').Tabledit({
            url:'action.php',
            columns:{
            identifier:[0, "id"],
            editable:[[1, 'first_name'], [2, 'last_name']]
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