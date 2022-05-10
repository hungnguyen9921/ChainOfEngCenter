window.addEventListener("load", function(e){
    const toggleMenu = document.querySelector(".menu-toggle");
    const headerMenu = document.querySelector(".main-menu");
    toggleMenu.addEventListener("click", function(){
        headerMenu.classList.toggle("is-show");
        toggleMenu.classList.toggle("fa-bars");
        toggleMenu.classList.toggle("fa-times");
    });


});
