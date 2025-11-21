jQuery(document).ready(function($)
{
    var swiper = new Swiper(".swiper-imoveis", {
        slidesPerView: 4,
        spaceBetween: 15,
        speed: 1000,
        scrollbar: {
            el: ".swiper-scrollbar",
            draggable: true,
        },
        navigation: {
            nextEl: ".slide-imoveis .outer-next",
            prevEl: ".slide-imoveis .outer-prev",
        },
    });


    if( !IS_TABLET && !IS_MOBILE )
	{
        $('.slide').westSlide({
            slideMargin: 45,
            factorMoveScroll: 0.4,
        });

    }

});