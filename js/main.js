document.addEventListener("DOMContentLoaded", function(){
    const menu = document.querySelector("#menu");
    const hamburger = document.querySelector(".hm img");
    const closeBtn = document.querySelector(".arrow");
    const mainLinks = document.querySelectorAll(".mm2 > li > a");

    //메뉴 열기
    hamburger.addEventListener("click",function(){
        menu.style.transition = "margin-left 0.3s";
        menu.style.marginLeft = "240px";
    
    //메뉴닫기
    closeBtn.addEventListener("click",function(){
        menu.style.marginLeft = "0";
    });

    //서브메뉴 열기/닫기
    mainLinks.forEach(function(link){
        link.addEventListener("click",function(e){
            e.preventDefault();
            const subMenu = this.nextElementSibling;
            const isVisible = window.getComputedStyle(subMenu).display === "block";
    
    //모든 서브메뉴 닫기
    document.querySelectorAll(".sub").forEach(function(x){
        x.style.display = "none";
    });

    if(!isVisible) {
        subMenu.style.display = "block"
    }
        });
    });
 });

 /* 모달부분 */
 const modalback = document.querySelector(".modal_back");
 const openBtn = document.querySelector(".hm img");
 const closeBtn1 = document.querySelector(".arrow");

 function modalOn() {
    modalback.classList.add("back_on");
 }
 
 function modalOff() {
    modalback.classList.remove("back_on");
 }

 openBtn.addEventListener("click", modalOn);
 closeBtn1.addEventListener("click", modalOff);


});