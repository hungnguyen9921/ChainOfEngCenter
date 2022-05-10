const form = document.querySelector(".card-body form"),
continueBtn = form.querySelector(".signup"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
  e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "Chatbox/php/signup.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href="index1.php";
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