// JavaScript to be fired on all pages
jQuery( document ).ready(function($) {
  var check_rtl = false;
  if ($('html').attr('lang') == 'ar' || $('html').attr('dir') == 'rtl') {
    check_rtl = true;
  } else {
    check_rtl = false;
  }


  // ===== Slick Slider =====

  // related news slider
    var $postsSlider = $('.post-slider-single');
    var $dotsContainer = $('.related-news-slider .slider-dots');

    $postsSlider.on('init', function(event, slick) {
      if (slick.slideCount < 5) {
        $dotsContainer.hide();
      } else {
        $dotsContainer.show();
      }
    });

    $postsSlider.slick({
      dots: true,
      appendDots: $dotsContainer,
      arrows: true,
      prevArrow: $('.related-news-slider .prev-btn'),
      nextArrow: $('.related-news-slider .next-btn'),
      infinite: true,
      speed: 200,
      autoplay: true,
      rtl: check_rtl,
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

  // ===== Services Slider =====
    var $serviceSlider = $('.our_services_slider .services-slider');
    var $ServicesprogressLine = $('.our_services_slider .slick-progress .progress-line span');
    $serviceSlider.slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      infinite: true,
      centerMode: true,
      centerPadding: '0px',
      autoplay: true,
      autoplaySpeed: 2000,
      speed: 1000,
      pauseOnHover: false,
      pauseOnFocus: false,
      swipe: true,
      swipeToSlide: true,
      touchMove: true,
      speed: 1000,
      arrows: true,
      prevArrow: $('.our_services_slider .prev-btn'),
      nextArrow: $('.our_services_slider .next-btn'),
      rtl: check_rtl,
      responsive: [
        { breakpoint: 992, settings: { slidesToShow: 2 } },
        { breakpoint: 576, settings: { slidesToShow: 1 } }
      ]
    });

    $serviceSlider.find('.slick-slide').not('.slick-current').find('.second-img').hide();
    $serviceSlider.find('.slick-slide.slick-current').find('.default-img').hide();
    // $current.find('.second-img').stop(true,true).fadeOut(100);

    $serviceSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
      var $current = $(slick.$slides[currentSlide]);
      $current.find('.default-img').stop(true,true).fadeIn(100);
      $current.find('.second-img').stop(true,true).fadeOut(0);

      var $next = $(slick.$slides[nextSlide]);
      $next.find('.default-img').stop(true,true).fadeOut(0);
      $next.find('.second-img').stop(true,true).fadeIn(100);
    });

    // Function to handle progress bar
    function serviceUpdateCenterSlide(slick, index) {
      var current = index + 1;
      var total   = slick.slideCount;
      var percent = (current / total) * 100;
      $ServicesprogressLine.css('width', percent + '%');
    }

    $serviceSlider.on('init', function(event, slick){
      serviceUpdateCenterSlide(slick, slick.currentSlide);
    });

     $serviceSlider.on('init', function(event, slick){
      for (var i = 0; i < slick.slideCount; i++){
        setSlideState(slick, i, false);
      }
      setSlideState(slick, slick.currentSlide, true);
      updateCenterSlide(slick, slick.currentSlide);
      console.log('slick init, currentSlide=', slick.currentSlide);
    });

    $serviceSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
      serviceUpdateCenterSlide(slick, nextSlide);
    });

  // ===== Partners Slider =====

  var $logossSlider = $('.logos-slider .slick-slider');
  var $logosProgressLine = $('.logos-slider .slick-progress .progress-line span');

  $logossSlider.slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    infinite: true,
    autoplay: true,
    speed: 1000,
    arrows: true,
    appendArrows: $('.logos-slider .slick-progress'), // keep arrows in progress bar
    prevArrow: $('.logos-slider .prev-btn'),
    nextArrow: $('.logos-slider .next-btn'),
    dots: false,
    rtl: check_rtl,
    swipe: true,
    swipeToSlide: false,
    touchMove: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
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

  // Function to handle progress bar
  function logosUpdateCenterSlide(slick, index) {
    var current = index + 1;
    var total   = slick.slideCount;
    var percent = (current / total) * 100;
    $logosProgressLine.css('width', percent + '%');
  }

  $logossSlider.on('init', function(event, slick){
    logosUpdateCenterSlide(slick, slick.currentSlide);
  });

  $logossSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
    logosUpdateCenterSlide(slick, nextSlide);
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
    touchMove: true
  });

  /**
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
    */

  // Slick equal height
  // ===== Equal Heights for Slick Slides =====
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
