$(function() {
    // modify global settings
    $.extend($.fn.Tooltip.defaults, {
        track: true,
        delay: 0,
        showURL: false,
        showBody: " - "
    });
    $('a, input, img').Tooltip();
});