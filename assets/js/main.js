jQuery(document).ready(function($)
{

	__Scroll.activeToggleMenuFixed = false;


	// PASSIVE LISTENERS HACK
	$.event.special.scroll = {
	    setup: function( _, ns, handle ) {
	        this.addEventListener("scroll", handle, { passive: !ns.includes("noPreventDefault") });
	    }
	};



	//////////////////////////
	// ENTRANCE ANIMATION
	//////////////////////////

	if( IS_TABLET || IS_MOBILE )
	{

		$('.waypoint').each( function(i)
		{
			let bot_obj = $(this).offset().top + ( $(this).outerHeight() * 0.3 );
			let bot_win = $(window).scrollTop() + $(window).height();
			if( bot_win > bot_obj )
			{
				var element = $(this);

				if(!element.hasClass('animated')) {
					element.addClass('animated');
					element.trigger('animated');
				}
			}
		});

			
		var updateAnimation = function (e) {
			$('.waypoint').each( function(i)
			{
				let bot_obj = $(this).offset().top + ( $(this).outerHeight() * 0.35 );
				let bot_win = $(window).scrollTop() + $(window).height();
				if( bot_win > bot_obj )
				{
					let element = $(this);
					if(!element.hasClass('animated')) {
						element.addClass('animated');
						element.trigger('animated');
					}
				}
			});
		};


		window.addEventListener('scroll', updateAnimation, false);



		// SHOW/HIDE MENU FIXED SCROLL

		// $(window).scroll(function()
		// {
		// 	if( $(window).scrollTop() > 50 )
		// 	{
		// 		$('header').addClass('is-compact');
		// 	}else{
		// 		$('header').removeClass('is-compact');
		// 	}
		// });


		$(window).resize(function(){
			if( screen.width > 768 ) updateAnimation;
		});

		$(window).scroll();
	}









	// MENU

	$('.menu ul').fadeOut(0);
	// $('.menu .bt-close-menu').fadeOut(0);
	// $('.menu .logo').fadeOut(0);
	// $('.menu .phone').fadeOut(0);

	$('.navbar-burger').click(function(e)
	{
		e.preventDefault();

		if( $(this).hasClass("is-active") )
		{
			// CLOSE
			$('.menu ul').fadeOut(600);
			// $('.menu .bt-close-menu').fadeOut(100);
			// $('.menu .logo').fadeOut(300);
			// $('.menu .phone').fadeOut(100);

			setTimeout( () => { $('.menu').removeClass("is-active"); }, 800);
		}
		else
		{
			// SHOW
			$('.menu').addClass('is-active');

			setTimeout( () => { 
				$('.menu ul').fadeIn(0);
				// $('.menu .bt-close-menu').fadeIn(0);
				// $('.menu .logo').fadeIn(0);
				// $('.menu .phone').fadeIn(0);
			}, 800);
		}

		$(this).toggleClass('is-active');
	});



	$('.bt-close-menu').click(function(e)
	{
		$('.menu ul').fadeOut(400);
		// $('.menu .bt-close-menu').fadeOut(2400);
		// $('.menu .logo').fadeOut(300);
		// $('.menu .phone').fadeOut(300);

		$('.navbar-burger').toggleClass('is-active');

		setTimeout( () => { $('.menu').removeClass("is-active"); }, 400);
	});



	$('.menu .menu-item').click(function(e)
	{
		// $('.bt-close-menu').click();
		$('.navbar-burger').click();
	});

	




	// COOKIES

	$('#bt-cookies').click(function(e)
	{
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: HTTP+'php/ajax/aceitar-cookies.php',
			success: function(output)
			{
				if(output == 1) $('.cookies').fadeOut(200);
			}
		});
	});



	



	// MASK
	$('.telefone').mask('(99) 99999-9999');



	// SEND FORM
	$('#form-contato').submit(function()
	{
		const __this = $(this);
		var DATA 	 = $(this).serialize();

		$(this).find('button').addClass('is-loading');


		$.ajax({
			type: 'POST',
			url: HTTP + '/php/envios/Envio-contato.php',
			data: DATA,
			dataType: 'json',
			success: function(json)
			{
				__this.find('button').removeClass('is-loading');

				if(json.status=="1")
				{
					__this.find('input').val('');
					__this.find('textarea').val('');

					Swal.fire({
						title: 'SUCESSO!',
						html: json.message,
						icon: 'success',
						confirmButtonText: 'Ok'
					});
				}
				else
				{
					msgAlert(json.message);
				}
			}
		});
			
		return false;
	});

});


// function debounce(func, wait, immediate) {
//     var timeout;
//     return function() {
//         var context = this, args = arguments;
//         var later = function() {
//             timeout = null;
//             if (!immediate) func.apply(context, args);
//         };
//         var callNow = immediate && !timeout;
//         clearTimeout(timeout);
//         timeout = setTimeout(later, wait);
//         if (callNow) func.apply(context, args);
//     };
// }



function msgAlert(message){
	Swal.fire({ title: 'Ops!', html: message, icon: 'warning', confirmButtonText: 'Ok'});
}