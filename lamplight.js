const lamp = document.querySelector(".lamp");
const background = document.querySelector(".background");
lamp.addEventListener("click",()=>{
    background.classList.toggle("light");

});