$(function(){
    let isOpen = false;

    const hiddenItems = $(".cate01, .cate02, .cate03, .cate04");

    hiddenItems.hide();

    $(".cate-toggle").on("click",function(e){
       e.preventDefault();

        if(!isOpen) {
            hiddenItems
                .css("display", "block")
                .hide()
                .fadeIn(220);

            $(this).text("접기");
            isOpen = true;
        } else {
            hiddenItems.fadeOut(250);
            $(this).text("더보기");
            isOpen = false;
        }
    });
});