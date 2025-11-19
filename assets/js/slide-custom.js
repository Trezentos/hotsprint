jQuery(document).ready(function($)
{

	// CUSTOM SLIDE

	let currentIndex 	= 0;
	let slider 			= $('.slider-container .slider');
	let slides 			= $('.slider-container .slide');
	let subtitles		= $('.slider-container .subtitles .subtitle');
	let totalSlides 	= slides.length;
	let slideInterval 	= slider.attr('data-slide-timeout');


	if (typeof slideInterval === 'undefined') {
		slideInterval = "10";
	}

	// Função para ativar o slide atual e aplicar o efeito
	function showSlide(index) {

		slides.removeClass('active');
		subtitles.removeClass('active');

		let currentSlide 	= slides.eq(index);
		let effectClass 	= currentSlide.attr('class').split(' ')[1];
		let containerHeight = $('.slider-container').height();

		let subTitleCurrent	= subtitles.eq(index);

		subTitleCurrent.addClass('active');

		resetSlide(currentSlide);


		// Calcula os movimentos baseados nas dimensões da imagem e do container
		switch (effectClass) {

			case 'fx-zoom':
				slider.addClass('center-hor');
				currentSlide.css('transform', 'scale(1.3)');
			break;


			case 'fx-to-left':
				// Calcula a diferença entre a largura da imagem e o container
				let imageWidth 		= currentSlide[0].naturalWidth;
				let containerWidth 	= $(window).width();
				let moveDistanceX 	= imageWidth - containerWidth;

				if (moveDistanceX > 0) {
					currentSlide.css('transform', 'translateX(-' + moveDistanceX + 'px)');
				} else {
					currentSlide.css('transform', 'translateX(0)'); 
				}
			break;


			case 'fx-to-bottom':
				// Calcula a diferença entre a altura da imagem e o container
				// let imageHeight 	= currentSlide[0].naturalHeight;
				let imageHeight 	= currentSlide[0].height;
				let moveDistanceY 	= imageHeight - containerHeight;

				if (moveDistanceY > 0) {
					currentSlide.css('transform', 'translateY(-' + moveDistanceY + 'px)');
				} else {
					currentSlide.css('transform', 'translateY(0)'); 
				}
			break;


			default: break;
		}

		currentSlide.addClass('active');
	}


	// RESET
	function resetSlide(slide) {
		slide.css({
		'transform': 'translateX(0) translateY(0) scale(1)', 'transition': 'none'
		});

		slide[0].offsetHeight;
		slide.css('transition', 'transform '+slideInterval+'s cubic-bezier(0.48,0.17,.28,1), opacity 1s linear');

		slider.removeClass('center-hor');
	}



	function nextSlide() {
		currentIndex = (currentIndex + 1) % totalSlides; 
		showSlide(currentIndex);
	}

	function prevSlide() {
		currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; 
		showSlide(currentIndex);
	}


	

	// EVENTS ARROWS
	$('.slider-container #next').click( () => {
		nextSlide();
	});

	$('.slider-container #prev').click( () => {
		prevSlide();
	});


	// INIT SLIDE WITH DELAY
	setTimeout( () => {
		showSlide(currentIndex);

		// LOOP
		setInterval(nextSlide, slideInterval * 1000);
	}
	, ( !IS_MOBILE ? 5000 : 1000) );

});