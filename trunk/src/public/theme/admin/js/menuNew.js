function mainmenu(){
    $(" .drospdown ul ").css({
        display: "none"
    }); // Opera Fix
    $(" .drospdown li").hover(function(){
        $(this).find('ul:first').css({
            visibility: "visible",
            display: "none"
        }).slideDown(400);
    },function(){
        $(this).find('ul:first').slideUp(400);
    });
}
$(document).ready(function(){ 
    mainmenu();
});