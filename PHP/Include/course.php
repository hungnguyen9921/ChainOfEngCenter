<?php
    session_start();
    include('../db/ketnoi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../css/course.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<style>
        body{
            background-repeat: repeat;
        }
        
    </style>
    <header style="margin : 17px 0px 70px 0px">
        <div class="inner-header">
            <a href="../index1.php">
                <img src="../img/Logo.png" alt="" class="logo">
            </a>
            <div class="search-bar">
                <div class="search-bar__title">
                    <h3 style="margin-bottom:0px">tìm kiếm</h3>
                    <h3 style="margin-bottom:0px">khóa học</h3>
                </div>
                <form action="" method="post" class = "find-input__container">
                    <input type="text" name="idCourse" class="find-input" placeholder="Tìm kiếm ...">
                    <button type="submit" class= "button-search">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="navbar-icon">
                <ul class="main-menu">
                    <li>
                        <a href="./admin/admintotal.php" class="item-link">Nhân viên</a>
                    </li>
                    <li>
                        <a href="" class="item-link">Giáo viên</a>
                    </li>
                    <li>
                        <a href="" class="item-link">Thời khóa biểu</a>
                    </li>
                    <li>
                        <a href="./include/course.php" class="item-link">Khóa học</a>
                    </li>
                    <li>
                        <a href="../student/profile.php" class="item-link">Học viên</a>
                    </li>
                </ul>
                <a href="Dangnhap.php" class="login-header">
                    <i class="fas fa-user"></i>
                </a>
                <i class="fas menu-toggle fa-bars" aria-hidden="true"></i>
            </div>
        </div>
    </header>
<div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row">
        <div class="col-md-6 col-xl-12">
    
        <?php
            $output='';
            $sqlcourse = mysqli_query($con,"SELECT * FROM course");
            if(mysqli_num_rows($sqlcourse) > 0){
              while($rowcourse = mysqli_fetch_assoc($sqlcourse)){
                $idcourse = $rowcourse['CID'];
                $sqlteach = mysqli_query($con, "SELECT * FROM teach WHERE CID = '{$idcourse}'");
                $rowteach = mysqli_fetch_assoc($sqlteach);
                $idteach = $rowteach['TID'];
                $sqlteacher = mysqli_query($con, "SELECT * FROM employee WHERE EID = '{$idteach}'");
                $rowteacher = mysqli_fetch_assoc($sqlteacher);
                $sqlratecourse = mysqli_query($con, "SELECT * FROM ratecourse WHERE CID = '{$idcourse}'");
                $rowratecourse = mysqli_fetch_assoc($sqlratecourse);
                $sqlrateteach = mysqli_query($con,"SELECT * from rateteacher WHERE TID ='{$rowteacher['EID']}'");
                $rowrateteach = mysqli_fetch_assoc($sqlrateteach);
                $output .='<div class="card card-body mt-3">
                <div class="media align-items-center text-center text-lg-left flex-column flex-lg-row">
                    <div class="mr-2 mb-3 mb-lg-0"> <img src="../img/'. $rowteacher['Email'] .'.png" width="150" height="150" alt=""> </div>
                    <div class="media-body">
                        <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">ID Khóa Học: '. $rowcourse['CID'] .'</a> </h6>
                        <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                            <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Cấp độ: '. $rowcourse['Level'] .'</a></li>
                            <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true"></a></li>
                        </ul>
                        <p class="mb-3">Thời lượng: '. $rowcourse['Duration'] .' </p>
                        <p class="mb-3">Ngày Bắt Đầu: '. $rowcourse['StartDate'] .' </p>
                        <p class="mb-3">Giờ Học: '. $rowcourse['CTime'] .' </p>
                        <ul class="list-inline list-inline-dotted mb-0">
                            <li class="list-inline-item">Bấm vào đây để xem thêm <i id="myBtn"class="fas fa-eye showdetail"></i></li>
                            <div id="myModal" class="modal">
                                <!-- Modal content -->
                                <div class="modal-content" style="width:40%" >
                                    <div class="modal-header">
                                        <h3>'. $rowteacher['Name'] .' </h3>
                                        <span class="close">&times;</span>
                                        </div>
                                        <div class="modal-body">
                                        <p>Email: '. $rowteacher['Email'] .'</p>
                                        <p>Giới tính: '. $rowteacher['Sex'] .'</p>
                                        <p>Kỹ Năng: Nghe('.$rowrateteach['Listening'].') Nói('.$rowrateteach['Speaking'].') 
                                        Đọc('.$rowrateteach['Reading'].') Viết('.$rowrateteach['Writing'].')</p>
                                        </div>
                                        <div class="modal-footer">
                                        <h3></h3>
                                    </div>
                                </div>

                            </div>
                        </ul>
                    </div>
                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                        <h3 class="mb-0 font-weight-semibold">$'. $rowcourse['Tuition'] .'</h3>
                        <div> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                        <div class="text-muted">
                            Đánh giá của học viên <i class="fas fa-eye showrate"></i>
                        </div>
                        <div class="text-muted show-rate" style="display:none">'.$rowratecourse['Rate'].'</div>
                        <form class="form-submit" action"addcourse.php">
                            <input type="hidden" name="idcourse" id="idcourse" value="'.$rowcourse['CID'].'">
                            <button type="submit" name="addcourse" class="btn btn-warning text-white mt-2 insertcourse"> Đăng Ký Khóa Học </button>
                        </form>
                    </div>
                </div>
            </div>';
              }
              echo $output;
            }
        ?>
        </div>
    </div>
</div>

<script src="course.js"></script>
<script>
  $(document).ready(function(){
        $('.find-input').keyup(function(){
            var text = $('.find-input').val();
            $.post('search.php', {data : text}, function(data){
                $('.row').html(data);
            })
        });

        $(document).on("click",".insertcourse",function(e){
            e.preventDefault();
            $this = $(this);
            var col = $this.closest("form");
            var id = col.find("#idcourse").val();
            $.ajax({
                url: "addcourse.php",
                method: "post",
                data: {idcourse:id},
                success: function(result){
                    var json = $.parseJSON(result);
                    if(json.response.status == 'error'){
                        sweetAlert2("Bạn đã đăng ký khóa học");
                    }
                    else{
                        sweetAlert1("Đăng Ký Thành Công");
                    }
                },
            })
            // var form = $(this).closet('form');
            // var id = form.find("#idcourse").val();
            // console.log(id);
        });
        
        let btn = document.querySelectorAll(".showdetail");
        let span = document.querySelectorAll(".close");
        let modal = document.querySelectorAll("#myModal");
        for(let i = 0; i< btn.length; i++){
            btn[i].addEventListener("click",function(){
                showdetail(i);
            });
        };
        for(let i = 0; i< btn.length; i++){
            span[i].addEventListener("click",function(){
                offdetail(i);
            });
        };
        function showdetail(index){
            modal[index].style.display = "block";
        };

        function offdetail(index){
            modal[index].style.display = "none";
        };

        $(".showrate").on("click",function(){
            var $this = $(this);
            $this.toggleClass("fa-eye-slash");
            $this = $this.closest('div');
            if($this.next().css("display") == "flex"){
                $this.next().css({"display":"none"});
            }else{
                $this.next().css({"display":"flex"});
            }
        });
	});
    
</script>
</body>
</html>