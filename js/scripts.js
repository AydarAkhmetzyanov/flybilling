$(function() {
	$.stellar({
		responsive: true,
		horizontalScrolling: false
	});

    $('.footer-logo').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 2000);
        return false;    
    });
});

function calculatePromoHeight() {
    $('.top-promo .container').css({
        height: $('.hero-unit').outerHeight() + 70
    });
}