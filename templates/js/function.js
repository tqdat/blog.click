$(document).ready(function(){

        
        $(".intro_home").ellipsis({
            row: 3, 'onlyFullWords': true
        });


        $("#bars").click(function(){
		$('#menuItem').css({"transform":"translateZ(0) scale(1.0, 1.0)","-webkit-transform":"translateZ(0) scale(1.0, 1.0)"});
	});
	$("#bars-close").click(function(){
		$('#menuItem').css({"transform":"translateX(-130%)","-webkit-transform":"translateX(-130%)"});
	});
        
        $("#navResponsive .open").click(function(){
                $(this).parent().find(".open").hide();
                $(this).parent().find(".exit").show();
                $(this).parent().find(".subNavResponsive").slideDown();
	});
        $("#navResponsive .exit").click(function(){
                $(".exit").hide();
                $(".open").show();
                $(this).parent().find(".subNavResponsive").slideUp();
	});
    
	//Cắt chữ
	$(".hotel-info .description").ellipsis({
		row: 3, position: 'tail', onlyFullWords: true
	});
	$(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.hotline-footer').fadeIn();
                $('.hotline-footer').show();
            } else {
                $('.hotline-footer').hide();
            }
        });
	//Tabs
	$(".listtab li").click(function(){
		var data_id = $(this).attr('data_id');
		$(".listtab li").removeClass('active');
		$(this).addClass('active');
		$(".tabcon").hide();
		$("#"+data_id).show();
	});
	//Ticker
	
	//Ticker
	$('.hotel-up').easyTicker({
		direction: 'up',
		easing: 'swing',
		speed: 'slow',
		interval: 3000,
		height: 'auto',
		visible: 3,
		mousePause: 1,
		controls: {
			up: '',
			down: '',
			toggle: '',
			playText: 'Play',
			stopText: 'Stop'
		}
	});
	/*Back to top*/
	$(function(){$(window).scroll(function(){if($(this).scrollTop()!=0){$('#bttop').fadeIn();}else{$('#bttop').fadeOut();}});$('#bttop').click(function(){$('body,html').animate({scrollTop:0},800);});});
});