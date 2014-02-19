$(function() {
        scrollToId(window.location.hash, 1);    

        $('.footer-logo').click(function() {
                $('html, body').animate({
                        scrollTop: 0
                    }, 2000);
                $('.nav a').removeClass('active');
                return false;    
        });

        $('.nav a').click(function() {
                var self = $(this);
                $('.nav a').removeClass('active');
                self.addClass('active');
                scrollToId(self.attr('href'), 2000);
                return false;
        });

        $('.resp-slider-slides').bxSlider({
                nextSelector: '.to-right',
                prevSelector: '.to-left',
                nextText: '',
                prevText: '',
                pager: false,
                mode: 'vertical'
        });

        calculatePromoHeight();
});


$(window).scroll(function() {
    if ($('#is-main-page').length) {
        changeMenuSelection();
    }
});

$(window).resize(function() {
   if ($('#is-main-page').length) {
        calculatePromoHeight();
   } 
});

function scrollToId(id, dur) {
    if (id !== '' && $(id).length) {
        $('html, body').animate({
            scrollTop: $(id).offset().top
        }, dur, function() {
            window.location.hash = id;
            $('.nav a').removeClass('active');
            $('.nav a[href="' + id + '"]').addClass('active');
        });
    }
    changeMenuSelection();
    return false;
}

function changeMenuSelection() {
    //console.log($(window).scrollTop());

    if ($(window).scrollTop() == 0) {
        window.location.hash = '';
    }
}