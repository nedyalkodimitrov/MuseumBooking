$(document).ready(function() {

    var sliding = false,
        curSlide = 1,
        numOfSlides = $(".slider--el").length,
        autoSlideDelay = 6000,
        autoSlideTimeout;
    $

    $(document).on("click", ".slider--control", function() {
        if (sliding) return;
        sliding = true;
        $(".slider--el").show();
        $(".slider--el").css("top");
        $(".slider--el.active").addClass("removed");
        ($(this).hasClass("right")) ? curSlide++ : curSlide--;
        if (curSlide < 1) curSlide = numOfSlides;
        if (curSlide > numOfSlides) curSlide = 1;
        $(".slider--el-" + curSlide).addClass("next");

        setTimeout(function() {
            $(".slider--el.removed").hide();
            $(".slider--el").removeClass("active next removed");
            $(".slider--el-" + curSlide).addClass("active");
            sliding = false;
        }, 1800);
    });

    function autoSlide() {
        autoSlideTimeout = setTimeout(function() {
            changeSlides();
        }, autoSlideDelay);
    };

    autoSlide();
    function changeSlides(instant) {
        if (sliding) return;
        sliding = true;
        $(".slider--el").show();
        $(".slider--el").css("top");
        $(".slider--el.active").addClass("removed");
        ($(this).hasClass("right")) ? curSlide++ : curSlide--;
        if (curSlide < 1) curSlide = numOfSlides;
        if (curSlide > numOfSlides) curSlide = 1;
        $(".slider--el-" + curSlide).addClass("next");

        setTimeout(function() {
            $(".slider--el.removed").hide();
            $(".slider--el").removeClass("active next removed");
            $(".slider--el-" + curSlide).addClass("active");
            sliding = false;
        }, 1800);
        window.clearTimeout(autoSlideTimeout);
        autoSlide();
    }



});





//
// $(document).ready(function() {
//
//     var $slider = $(".slider"),
//         $slideBGs = $(".slide__bg"),
//         diff = 0,
//         curSlide = 0,
//         numOfSlides = $(".slide").length-1,
//         animating = false,
//         animTime = 500,
//         autoSlideTimeout,
//         autoSlideDelay = 6000,
//         $pagination = $(".slider-pagi");
//
//     function createBullets() {
//         for (var i = 0; i < numOfSlides+1; i++) {
//             var $li = $("<li class='slider-pagi__elem'></li>");
//             $li.addClass("slider-pagi__elem-"+i).data("page", i);
//             if (!i) $li.addClass("active");
//             $pagination.append($li);
//         }
//     };
//
//     createBullets();
//
//     function manageControls() {
//         $(".slider-control").removeClass("inactive");
//         if (!curSlide) $(".slider-control.left").addClass("inactive");
//         if (curSlide === numOfSlides) $(".slider-control.right").addClass("inactive");
//     };
//
//     function autoSlide() {
//         autoSlideTimeout = setTimeout(function() {
//             curSlide++;
//             if (curSlide > numOfSlides) curSlide = 0;
//             changeSlides();
//         }, autoSlideDelay);
//     };
//
//     autoSlide();
//
//     function changeSlides(instant) {
//         if (!instant) {
//             animating = true;
//             manageControls();
//             $slider.addClass("animating");
//             $slider.css("top");
//             $(".slide").removeClass("active");
//             $(".slide-"+curSlide).addClass("active");
//             setTimeout(function() {
//                 $slider.removeClass("animating");
//                 animating = false;
//             }, animTime);
//         }
//         window.clearTimeout(autoSlideTimeout);
//         $(".slider-pagi__elem").removeClass("active");
//         $(".slider-pagi__elem-"+curSlide).addClass("active");
//         $slider.css("transform", "translate3d("+ -curSlide*100 +"%,0,0)");
//         $slideBGs.css("transform", "translate3d("+ curSlide*50 +"%,0,0)");
//         diff = 0;
//         autoSlide();
//     }
//
//     function navigateLeft() {
//         if (animating) return;
//         if (curSlide > 0) curSlide--;
//         changeSlides();
//     }
//
//     function navigateRight() {
//         if (animating) return;
//         if (curSlide < numOfSlides) curSlide++;
//         changeSlides();
//     }
//