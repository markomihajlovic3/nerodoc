$(document).ready(function(){



    $(window).scroll(function() {    
	var scroll = $(window).scrollTop();

	//>=, not <=
	if(scroll >= 200) {
            $("#first-section").addClass("seethrough");
	}
	else{
	    $("#first-section").removeClass("seethrough");
	}


	if(scroll >= 500) {
            $("#second-section").addClass("seethrough");
	}
	else{
	    $("#second-section").removeClass("seethrough");
	}
    });


    $('.scroll-capsule a i').click(function(){
	$('.scroll-capsule i').removeClass('active-nav');
	$(this).addClass('active-nav');

	var parentLink = $(this).parent();
	var href = parentLink.attr('href');

	$('html, body').animate({
            scrollTop: $(href).offset().top - 150
	}, 1000);
    });


    //fade in the welcome message
    $('.flash').fadeIn(2000);

});
