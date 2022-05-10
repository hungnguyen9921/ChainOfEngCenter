const pswrdField = document.querySelector(".col-lg-6 input[type='password']"),
toggleIcon = document.querySelector(".col-lg-6 .hiddenpw");

toggleIcon.onclick = () =>{
  if(pswrdField.type === "password"){
    pswrdField.type = "text";
    toggleIcon.classList.add("active");
  }else{
    pswrdField.type = "password";
    toggleIcon.classList.remove("active");
  }
}
