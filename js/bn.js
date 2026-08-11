document.addEventListener("DOMContentLoaded", initSlider);

function initSlider() {
    const mainImage = document.querySelector("#mainbanner");
    if (!mainImage) return;

    const ul = mainImage.querySelector(".slider");
    const imgs = ul.querySelectorAll("li");
    const idcRoll = document.querySelectorAll("#idc > button");

    let currentIndex = 0;
    const totalSlides = imgs.length;
    let autoSlideInterval;

    function slideTo(index) {
        if (index < 0) index = 0;
        if (index >= totalSlides) index = totalSlides - 1;

        ul.style.transition = "left 0.5s";
        ul.style.position = "relative";
        ul.style.left = -(100 * index) + "%";
        currentIndex = index;
        updateIndicators();
    }

    function updateIndicators() {
        for (let i = 0; i < idcRoll.length; i++) {
            const isActive = i === currentIndex;
            idcRoll[i].classList.toggle("idc_on", isActive);
            idcRoll[i].setAttribute("aria-pressed", String(isActive));
        }
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(function () {
            let nextIndex = currentIndex + 1;
            if (nextIndex >= totalSlides) {
                nextIndex = 0;
            }
            slideTo(nextIndex);
        }, 3000);
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    function setEventListeners() {
        for (let i = 0; i < idcRoll.length; i++) {
            idcRoll[i].addEventListener("click", createIdcRollclickHandler(i));
        }
        window.addEventListener("resize", onResize);
    }

    function createIdcRollclickHandler(index) {
        return function (e) {
            e.preventDefault();
            stopAutoSlide();
            slideTo(index);
            startAutoSlide();
        };
    }

    function onResize() {
        slideTo(currentIndex);
    }

    slideTo(0);
    startAutoSlide();
    setEventListeners();
}