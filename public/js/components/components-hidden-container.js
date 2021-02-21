 function openContainer(trigger, target){
    $("."+trigger+"").on("click", function (){
        $("#"+target+"").css("transform", "translateY(0%)");
    });
 }

 function closeContainer(trigger, target){
    $("."+trigger+"").on("click", function (){
        $("#"+target+"").css("transform", "translateY(-100%)");
    });
 }