// JavaScript to be fired on all pages
jQuery( document ).ready(function($) {
  var check_rtl = false;
  if ($('html').attr('lang') == 'ar' || $('html').attr('dir') == 'rtl') {
    check_rtl = true;
  } else {
    check_rtl = false;
  }
  // ===== Slick Slider =====
  // post slider
    var $slider = $('.post-slider');
    var $dotsContainer = $('.latest-news-slider .slider-dots');

    $slider.on('init', function(event, slick) {
      if (slick.slideCount < 5) {
        $dotsContainer.hide();
      } else {
        $dotsContainer.show();
      }
    });

    $slider.slick({
      dots: true,
      appendDots: $dotsContainer,
      arrows: true,
      prevArrow: $('.latest-news-slider .prev-btn'),
      nextArrow: $('.latest-news-slider .next-btn'),
      infinite: true,
      speed: 200,
      autoplay: true,
      rtl: typeof check_rtl !== 'undefined' ? check_rtl : false,
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1025,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });

  // ===== Slick Slider =====
  // related news slider
    var $slider = $('.post-slider-single');
    var $dotsContainer = $('.related-news-slider .slider-dots');

    $slider.on('init', function(event, slick) {
      if (slick.slideCount < 5) {
        $dotsContainer.hide();
      } else {
        $dotsContainer.show();
      }
    });

    $slider.slick({
      dots: true,
      appendDots: $dotsContainer,
      arrows: true,
      prevArrow: $('.related-news-slider .prev-btn'),
      nextArrow: $('.related-news-slider .next-btn'),
      infinite: true,
      speed: 200,
      autoplay: true,
      rtl: typeof check_rtl !== 'undefined' ? check_rtl : false,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1025,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });



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
  var $heroSlider = $('.main-slider .slide-wrapper')
  var heroSliderCount = $heroSlider.children().length

  $heroSlider.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    autoplay: false,
    speed: 1000,
    arrows: true,
    prevArrow: $('.main-slider .prev-btn'),
    nextArrow: $('.main-slider .next-btn'),
    dots: heroSliderCount > 1,
    appendDots: $('.main-slider .custom-dots'),
    rtl: check_rtl,
    pauseOnHover: true,
    pauseOnFocus: true,
    fade: true,
    swipe: true,
    swipeToSlide: true,
    touchMove: true,
  })

  // Services Slider
  $('.services-slider .slider-cards').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,
    autoplay: true,
    speed: 1000,
    prevArrow: $('.services-slider .prev-btn'),
    nextArrow: $('.services-slider .next-btn'),
    dots: true,
    appendDots: $('.services-slider .custom-dots'),
    rtl: check_rtl,
    pauseOnHover: true,
    pauseOnFocus: true,
    swipe: true,
    swipeToSlide: false,
    touchMove: true,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
          centerPadding: '60px',
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          centerPadding: '30px',
        },
      },
    ],
  });

  $('.services-slider .slider-cards .item .wrapper, .posts-archive__list .card').hover(
    function () {
      let shortText = $(this).find('.desc').attr('data-short');
      let fullText = $(this).find('.desc').attr('data-full');
      let extraText = fullText.replace(shortText, '').trim();
      let $short = $(this).find('.short');

      $short.html(shortText + ' ' + extraText);

      let fullHeight = $short.prop('scrollHeight');
      $short.css('max-height', fullHeight + 'px');
    },
    function () {
      let $short = $(this).find('.short');
      let shortText = $(this).find('.desc').attr('data-short');
      $short.css('max-height', '95px');
      setTimeout(function () {
        $short.html(shortText + '');
      }, 200);
    }
  );

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




