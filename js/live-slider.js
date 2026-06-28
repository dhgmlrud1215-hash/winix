$(function(){
    let index = 0;
    const itemCount = $(".limited-group").length;

    $(".limi-left").click(function(){

        if(index > 0) {
            index--;
            $(".limited-track").css("transform", "translateX(" + (-index * 100) + "%)");

        }
    });


     $(".limi-right").click(function(){

        if(index < itemCount-1) {
            index++;
            $(".limited-track").css("transform", "translateX(" + (-index * 100) + "%)");

        }
    });
});