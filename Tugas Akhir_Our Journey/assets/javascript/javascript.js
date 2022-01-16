$(function klikMenu(){
    $(".tombol-menu").click(function(){
        $("nav .menu ul").toggle(500);
    });
});

$(document).ready(function () {
    var width = $(window).width();
    if (width < 990) {
        $("nav .menu ul").css("display","none");
    }
})

//check lebar
$(window).resize(function () {
    var width = $(window).width();
    if (width > 989) {
        $("nav .menu ul").css("display", "block");
        //display:block
    } else {
        $("nav .menu ul").css("display", "none");
    }
    klikMenu();
});

//EFEK SCROLL
$(document).ready(function () {
    var scroll_pos = 0;
    $(document).scroll(function(){
        scroll_pos=$(this).scrollTop();
        if(scroll_pos > 0) {
            $("nav").addClass("background-scroll");
        } else {
            $("nav").removeClass("background-scroll");
        }
    })
});