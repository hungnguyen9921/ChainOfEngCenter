<?php
    session_start();
    include('../db/ketnoi.php');
    $find = $_POST['data'];
    $sqlsearch = mysqli_query($con,"SELECT * FROM course WHERE 
                                (Level LIKE '%{$find}%') OR (CID LIKE '%{$find}%')");
    $output1 ="";                          
    if(mysqli_num_rows($sqlsearch) > 0){
        while($rowsearch = mysqli_fetch_assoc($sqlsearch)){
            $idcourse = $rowsearch['CID'];
            $sqlteach = mysqli_query($con, "SELECT * FROM teach WHERE CID = '{$idcourse}'");
            $rowteach = mysqli_fetch_assoc($sqlteach);
            $idteach = $rowteach['TID'];
            $sqlteacher = mysqli_query($con, "SELECT * FROM employee WHERE EID = '{$idteach}'");
            $rowteacher = mysqli_fetch_assoc($sqlteacher);
            $sqlratecourse = mysqli_query($con, "SELECT * FROM ratecourse WHERE CID = '{$idcourse}'");
            $rowratecourse = mysqli_fetch_assoc($sqlratecourse);
?>

<?php 
              $output1 .='<div class="col-md-6 col-xl-12">                       
            <div class="card card-body mt-3">
            <div class="media align-items-center text-center text-lg-left flex-column flex-lg-row">
                <div class="mr-2 mb-3 mb-lg-0"> <img src="../img/'. $rowteacher['Email'] .'.png" width="150" height="150" alt=""> </div>
                <div class="media-body">
                    <h6 class="media-title font-weight-semibold"> <a href="#" data-abc="true">ID Khóa Học: '. $rowsearch['CID'] .'</a> </h6>
                    <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Cấp độ: '. $rowsearch['Level'] .'</a></li>
                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true"></a></li>
                    </ul>
                    <p class="mb-3">Thời lượng: '. $rowsearch['Duration'] .' </p>
                    <p class="mb-3">Ngày Bắt Đầu: '. $rowsearch['StartDate'] .' </p>
                    <p class="mb-3">Giờ Học: '. $rowsearch['CTime'] .' </p>
                    <ul class="list-inline list-inline-dotted mb-0">
                        <li class="list-inline-item">Bấm vào đây để xem thêm <i class="fas fa-eye showdetail"></i></li>
                    </ul>
                </div>
                <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                    <h3 class="mb-0 font-weight-semibold">$'. $rowsearch['Tuition'] .'</h3>
                    <div> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                    <div class="text-muted">
                        Đánh giá của học viên <i class="fas fa-eye showrate"></i>
                    </div>
                    <div class="text-muted show-rate" style="display:none">'.$rowratecourse['Rate'].'</div>
                    <button type="button" class="btn btn-warning mt-4 text-white addcourse">
                        <i class="icon-cart-add mr-2"></i> Đăng Ký Khóa Học
                    </button>
                </div>
            </div>
        </div>
              </div>';

            }
            echo $output1;
        }    
?>
<script>
    $(document).ready(function(){
      $(".showdetail").on("click",function(){
            var $this = $(this);
            $this.toggleClass("fa-eye-slash");
            $this = $this.closest('ul');
            if($this.next().css("display") == "flex"){
                $this.next().css({"display":"none"});
            }else{
                $this.next().css({"display":"flex"});
            }
        });

        function sweetAlert(title) {
          console.log(2);
          const template = ` <div class="sweet-alert">
          <i class="fa fa-check sweet-icon"></i>
          <p class="sweet-text">${title}</p>
          </div>`;
          document.body.insertAdjacentHTML("beforeend", template);
        }

        let add = document.querySelectorAll(".addcourse");
        for(let i = 0; i< add.length; i++){
            add[i].addEventListener("click", function(){
                console.log(1);
                sweetAlert("Bạn đã đăng ký khóa học");
            })
        }
        })
</script>