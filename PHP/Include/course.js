
function sweetAlert1(title) {
    const template = ` <div class="sweet-alert">
    <i class="fa fa-check sweet-icon"></i>
    <p class="sweet-text">${title}</p>
    </div>`;
    document.body.insertAdjacentHTML("beforeend", template);
}

function sweetAlert2(title){
    const template = ` <div class="sweet-alert2">
    <i class="fa fa-check sweet-icon"></i>
    <p class="sweet-text">${title}</p>
    </div>`;
    document.body.insertAdjacentHTML("beforeend", template);
}
let btn = document.querySelectorAll(".showdetail");
let span = document.querySelectorAll(".close");
let modal = document.querySelectorAll("#myModal");
for(let i = 0; i< btn.length; i++){
    btn[i].addEventListener("click",function(){
        console.log(1);
        showdetail(i);
    });
};
for(let i = 0; i< btn.length; i++){
    span[i].addEventListener("click",function(){
        offdetail(i);
    });
};
function showdetail(index){
    modal[index].css.display = "block";
};

function offdetail(index){
    modal[index].style.display = "none";
};
// let add = document.querySelectorAll(".addcourse");
// for(let i = 0; i< add.length; i++){
//     add[i].addEventListener("click", function(){
//         sweetAlert1("Bạn đã đăng ký khóa học");
//     })
// }
