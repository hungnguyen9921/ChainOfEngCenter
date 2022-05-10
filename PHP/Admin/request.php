<?php
    session_start();
    include('../db/ketnoi.php');
    $sqladmincourse = mysqli_query($con,"SELECT* FROM course_mng WHERE ID ='{$_SESSION['unique_id']}'");
    if(mysqli_num_rows($sqladmincourse)<=0){
        $message = "Bạn Không thể truy cập vào trang này vui lòng xem lại";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='admintotal.php';
        </script>";
    }
    $query = "SELECT * FROM request ORDER BY Status DESC ";
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                    <a href="./giangvien.php"  class="list-group-item list-group-item-action">Giảng viên</a>
                    <a href="./student.php" class="list-group-item list-group-item-action">Học viên</a>
                    <a href="./mainadmin.php"  class="list-group-item list-group-item-action">Quản lí chi nhánh</a>
                    <a href="./admincourse.php"  class="list-group-item list-group-item-action">Quản lí khóa học</a>
                    <a href="./results.php"  class="list-group-item list-group-item-action">Kết quả học tập</a>
                    <a href="./course.php" class="list-group-item list-group-item-action">Khóa học</a>
                    <a href="./request.php" class="list-group-item list-group-item-action active">Yêu Cầu</a>
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
                                    <th>RID</th>
                                    <th>ID Khóa Học</th>
                                    <th>ID Học Viên</th>
                                    <th>Họ và Tên</th>
                                    <th>Thời gian</th>
                                    <th>Nội Dung</th>
                                    <th>Trạng thái</th>
                                    <th>
                                       Chấp Nhận
                                    </th>
                                    <th>Hủy Yêu Cầu</th>
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
                                        <td>'.$row["RID"].'</td>
                                        <td>'.$row["CID"].'</td>
                                        <td>'.$row["StudentID"].'</td>
                                        <td>'.$rowresult["Name"].'</td>
                                        <td>'.$row["Time"].'</td>
                                        <td>'.$row["Content"].'</td>
                                        <td>'.$row["Status"].'</td>
                                        <td><button type="button" class="btn btn-success aceptrequest" style="color: #fff;">Chấp nhận</button></td>
                                        <td><button type="button" style="padding:18px;" class="btn btn-danger deleterequest" data-toggle="modal" data-target="#deletemodal">Hủy</button></td>
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
</div>
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModelLable" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dc3545;">
                <h5 class="modal-title" id="exampleModelLable" style="color: #fff;">Hủy Yêu Cầu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: #fff;">&times;</span>
                </button>
            </div>

            <form action="deleterequest.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <h4>Bạn muốn hủy yêu cầu này?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success dismissdelete" data-dismiss="modal">No</button>
                    <button type="submit" name="deletedata" class="btn btn-danger">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="aceptmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModelLable" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #28a745;">
                    <h5 class="modal-title" id="exampleModelLable" style="color: #fff;">Đồng Ý Yêu Cầu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"style="color: #fff;">&times;</span>
                    </button>
                </div>

                <form action="aceptrequest.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="acept_id" id="acept_id">
                        <h4>Bạn đồng ý yêu cầu này?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger dismissdelete" data-dismiss="modal">Không</button>
                        <button type="submit" name="aceptdata" class="btn btn-success">Có</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){  
        $('.deleterequest').on('click',function(){
            $('#deletemodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            $('#delete_id').val(data[0]);
        })
        $('.close').on('click',function(){
            $('#deletemodal').modal('hide');
        })
        $('.dismissdelete').on('click',function(){
            $('#deletemodal').modal('hide');
        })
        $('.aceptrequest').on('click',function(){
            $('#aceptmodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            $('#acept_id').val(data[0]);
            
        })
        $('.close').on('click',function(){
            $('#aceptmodal').modal('hide');
        })
        $('.dismissdelete').on('click',function(){
            $('#aceptmodal').modal('hide');
        })
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