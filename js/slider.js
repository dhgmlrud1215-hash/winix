
//베스트
$(function(){

let index = 0;
const itemCount = $(".bestslider ul li").length;
const visibleCount = 2;


$(".bright").click(function () {

    if (index < itemCount - visibleCount) {
        index++;

        $(".bestslider ul").css(
        "transform",
        `translateX(calc(-${index * 50}% - ${index * 6}px))`
      );
    }
});

$(".bleft").click(function () {

    if (index > 0) {
        index--;
        
        $(".bestslider ul").css(
        "transform",
        `translateX(calc(-${index * 50}% - ${index * 6}px))`
      );
    }
});


});


//이벤트
$(function(){

    let index=0;
    const itemCount = $(".evslider ul li").length;

    $(".eleft").click(function(){

        if(index > 0) {
            index--;
            $(".evslider ul").css("transform", "translateX(" + (-index * 100) + "%)");

        }
    });

    $(".eright").click(function(){

        if(index < itemCount - 1) {
            index++;
            $(".evslider ul").css("transform",  "translateX(" + (-index * 100) + "%)");

        }
    });
});


//리뷰
$(function () {

    let index = 0;
    const itemCount = $(".mrgroup .re").length;
    const visible = 2;

    $(".reright").click(function () {

        if (index < itemCount - visible) {
            index++;
            $(".mrgroup").css(
                "transform",
                "translateX(" + (-index * 50) + "%)"
            );
        }

    });

    $(".releft").click(function () {

        if (index > 0) {
            index--;
            $(".mrgroup").css(
                "transform",
                "translateX(" + (-index * 50) + "%)"
            );
        }

    });

});