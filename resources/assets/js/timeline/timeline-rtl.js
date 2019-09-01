var hidWidth;
var scrollBarWidths = 40;

var widthOfList = function(){
    var itemsWidth = 0;
    $('.item').each(function(){
        var itemWidth = $(this).outerWidth();
        itemsWidth+=itemWidth;
    });
    //alert(itemsWidth);
    return itemsWidth;
};

var widthOfHidden = function(){
    return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
};

var getLeftPosi = function(){
    return $('.list').position().left;
};

var reAdjust = function(){
    if (($('.wrapper').outerWidth()) < widthOfList()) {
        $('.scroller-right').show();
    }
    else {
        $('.scroller-right').hide();
        /*
     var leftPos = $('.item:first-child').position().left;
     $('.item').animate({left:"-="+leftPos+"px"},'slow');
     */
    }

    if (getLeftPosi()<0) {
        $('.scroller-left').show();
    }
    else {
        $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
        $('.scroller-left').hide();
    }
}

reAdjust();

$(window).on('resize',function(e){
    reAdjust();
});

$('.scroller-right').click(function() {

    $('.scroller-left').fadeIn('slow');
    $('.scroller-right').fadeOut('slow');

    $('.list').animate({right:0},'slow',function(){
        //reAdjust();
    });
});

$('.scroller-left').click(function() {
    //var leftPos = $('.item:first-child').position().left;
    //$('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
    //$('.scroller-left').hide();

    $('.scroller-right').fadeIn('slow');
    $('.scroller-left').fadeOut('slow');

    var right = -1 * (2 * ($('#box').parent().outerWidth() - $('#box').outerWidth()) + 80);

    $('.list').animate({right: + right + "px"},'slow',function(){

    });

});