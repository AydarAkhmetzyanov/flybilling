$(function() {
        scrollToId(window.location.hash, 1);    

        $('.brand, .footer-logo').click(function() {
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
            scrollTop: $(id).offset().top - 100
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
    if ($(window).scrollTop() <= $('#services').offset().top - 150) {
        $('.nav a').removeClass('active');
    }

    if ($(window).scrollTop() >= $('#services').offset().top - 150) {
        $('.nav a').removeClass('active');
        $('.nav a[href="#services"]').addClass('active');
    }

    if ($(window).scrollTop() >= $('#about').offset().top - 150) {
        $('.nav a').removeClass('active');
        $('.nav a[href="#about"]').addClass('active');
    }

    if ($(window).scrollTop() >= $('#clients').offset().top - 150) {
        $('.nav a').removeClass('active');
        $('.nav a[href="#clients"]').addClass('active');
    }

    if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
        $('.nav a').removeClass('active');
        $('.nav a[href="#contacts"]').addClass('active');
    }
}