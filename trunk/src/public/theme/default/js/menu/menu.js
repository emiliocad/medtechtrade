function mainmenu(){
    $(" #nav-user ul ").css({
        display: "none"
    }); // Opera Fix
    $(" #nav-user li").hover(function(){
        $(this).find('ul:first').css({
            visibility: "visible",
            display: "none"
        }).show(200);
    },function(){
        $(this).find('ul:first').css({
            visibility: "hidden"
        });
    });
}

$(document).ready(function(){
    mainmenu();
});


