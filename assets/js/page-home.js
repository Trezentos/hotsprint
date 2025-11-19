jQuery(document).ready(function($)
{

    if( !IS_TABLET && !IS_MOBILE )
	{
        $('.slide').westSlide({
            slideMargin: 45,
            factorMoveScroll: 0.4,
        });

    }

});