var scaling = 1.40;
//count
var currentSliderCount = 0;
var videoCount = $(".c-elements-mini-slider__container").children().length;
var showCount = 4;
var sliderCount = videoCount / showCount;
var controlsWidth = 40;
var scollWidth = 0;


$(document).ready(function(){
    //$('.slider-container .slide:nth-last-child(-n+4)').prependTo('.slider-container');
    init();

});
$( window ).resize(function() {
    init();
});
function init(){
    // elements
    var win = $(window);
    var sliderFrame = $(".c-elements-mini-slider");
    var sliderContainer = $(".c-elements-mini-slider__container");
    var slide = $(".c-elements-mini-slider__container__slide");

    //counts
    var scollWidth = 0;

    //sizes
    var windowWidth = win.width();
    var frameWidth = win.width() - 80;
    if(windowWidth >= 0 && windowWidth <= 414){
        showCount = 2;
    }else if(windowWidth >= 414 &&  windowWidth <= 768){
        showCount = 3;
    }else{
        showCount = 4;
    }
    var videoWidth = ((windowWidth - controlsWidth * 2) / showCount );
    var videoHeight = Math.round(videoWidth / (16/9));

    var videoWidthDiff = (videoWidth * scaling) - videoWidth;
    var videoHeightDiff = (videoHeight * scaling) - videoHeight;



    //set sizes
    sliderFrame.width(windowWidth);
    sliderFrame.height(videoHeight * scaling);


    //sliderFrame.css("top", (videoHeightDiff / 2));

    sliderContainer.height(videoHeight * scaling);
    sliderContainer.width((videoWidth * videoCount) + videoWidthDiff);
    sliderContainer.css("top", (videoHeightDiff / 2));
    sliderContainer.css("margin-left", (controlsWidth));

    slide.height(videoHeight);
    slide.width(videoWidth);

    //hover effect
    $(".c-elements-mini-slider__container__slide").mouseover(function() {
        $(this).css("width", videoWidth * scaling);
        $(this).css("height", videoHeight * scaling);
        $(this).css("top", -(videoHeightDiff / 2));
        if($(".c-elements-mini-slider__container__slide").index($(this)) == 0 || ($(".c-elements-mini-slider__container__slide").index($(this))) % 4 == 0){
            // do nothing
        }
        else if(($(".c-elements-mini-slider__container__slide").index($(this)) + 1) % 4 == 0 && $(".c-elements-mini-slider__container__slide").index($(this)) != 0){
            $(this).parent().css("margin-left", -(videoWidthDiff - controlsWidth));
        }
        else{
            $(this).parent().css("margin-left", - (videoWidthDiff / 2));
        }
    }).mouseout(function() {
        $(this).css("width", videoWidth * 1);
        $(this).css("height", videoHeight * 1);
        $(this).css("top", 0);
        $(this).parent().css("margin-left", controlsWidth);
    });

    // controls
    controls(frameWidth, scollWidth);
}
function controls(frameWidth, scollWidth){
    var prev = $(".prev");
    var next = $(".next");

    next.on("click", function(){

        scollWidth = scollWidth - frameWidth;
        $('.c-elements-mini-slider__container').animate({
            left:  scollWidth
        }, 300, function(){
            if(currentSliderCount >= sliderCount-1){
                $(".c-elements-mini-slider__container").css("left", 0);
                currentSliderCount = 0;
                scollWidth = 0;
            }else{
                currentSliderCount++;
                console.log(currentSliderCount);
                console.log(sliderCount);

            }
        });
    });
    prev.on("click", function(){
        if ( currentSliderCount != 0){
            console.log(scollWidth);
            console.log(frameWidth);
            scollWidth = scollWidth + frameWidth;
            $('.c-elements-mini-slider__container').animate({
                left: + scollWidth
            }, 300, function(){
                currentSliderCount--;
            });
        }

    });
};