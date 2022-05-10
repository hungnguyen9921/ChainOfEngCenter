const form = document.querySelector(".contact100-form"),
continueBtn = form.querySelector(".container-contact100-form-btn button"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    console.log(1);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./getfeedback.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href = "../index1.php";
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}