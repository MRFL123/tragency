// JavaScript to be fired on all pages
jQuery( document ).ready(function($) {
  var check_rtl = false;
  if ($('html').attr('lang') == 'ar' || $('html').attr('dir') == 'rtl') {
    check_rtl = true;
  } else {
    check_rtl = false;
  }

  // ===== Slick Slider =====
  // Partners
  $('.partners .our-clients').slick({
    slidesToShow: 9,
    slidesToScroll: 3,
    loop: true,
    infinite: true,
    autoplay: true,
    speed: 1000,
    arrows: false,
    dots: true,
    rtl: check_rtl,
    swipe: true,
    swipeToSlide: false,
    touchMove: true,
    responsive: [{
      breakpoint: 1024,
        settings: {
            slidesToShow: 6,
            slidesToScroll: 2,
        },
      },
      {
      breakpoint: 800,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
    ],
  });

  // Hero Slider
  $('.main-slider .slide-wrapper').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    autoplay: false,
    speed: 1000,
    arrows: true,
    prevArrow: $('.main-slider .prev-btn'),
    nextArrow: $('.main-slider .next-btn'),
    dots: true,
    appendDots: $('.main-slider .custom-dots'),
    rtl: check_rtl,
    pauseOnHover: true,
    pauseOnFocus: true,
    fade: true,
    swipe: true,
    swipeToSlide: true,
    touchMove: true,
  })

  // Slick equal height
  function equalizeSlickSlideHeights() {
    $('.slick-slider').each(function () {
      let maxHeight = 0;

      $(this).find('.slick-slide').css('height', 'auto');

      $(this).find('.slick-slide').each(function () {
        let thisHeight = $(this).outerHeight();
        if (thisHeight > maxHeight) {
          maxHeight = thisHeight;
        }
      });

      $(this).find('.slick-slide').css('height', maxHeight);
    });
  }

  equalizeSlickSlideHeights();

  $('.slick-slider').on('setPosition', function () {
    equalizeSlickSlideHeights();
  });

  $(window).on('resize', function () {
    equalizeSlickSlideHeights();
  });
});




