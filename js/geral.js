$(document).ready(function() {
    $("input").addClass('radius5');
    $("textarea").addClass('radius5');
    $("fildset").addClass('radius5');
    // acordion
    $('#submenu a.item').click(function() {
        $('#submenu li').children('ul').slideUP('fast');
        $('#submenu li').each(function() {
            $(this).removeClass('active');
        });
        $(this).siblings('ul').slideDown('fast');
        $(this).parent().addClass('active');
        return false;
    });
});

// submenu
 