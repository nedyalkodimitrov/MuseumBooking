 function openContainer(trigger, target){
    $("."+trigger+"").on("click", function (){
        $("#"+target+"").css("transform", "translateY(0%)");
    });
 }

 function closeContainer(){
    $(".c-hidden-container__close-button").on("click", function (){
        $(".c-hidden-container").css("transform", "translateY(-100%)");
    });
 }