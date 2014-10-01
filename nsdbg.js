$(document).ready(function(){
    //$('.code').hide();
    $('.backtrace').on('click',function(){
        $(this).parent().find('.code').slideToggle({duration:500});
    });
    
    $('.group h3').on('click',function(){
        $(this).parent().parent().find('.entry').slideToggle({duration:500});
    });
});