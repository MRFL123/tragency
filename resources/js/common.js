// JavaScript to be fired on all pages
jQuery(document).ready(function ($) {
  var check_rtl = $('html').attr('lang') === 'ar' || $('html').attr('dir') === 'rtl';

  // ===== Services Slider =====
  var $slider = $('.services-slider');
  var $progressLine = $('.progress-line span');

  $slider.slick({
    centerMode: true,
    slidesToShow: 3,
    arrows: true,
    appendArrows: $('.services-slider-progress'), // keep arrows in progress bar
    prevArrow: $('.services-slider-progress .slick-prev'),
    nextArrow: $('.services-slider-progress .slick-next'),
    dots: false,
    rtl: check_rtl,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          centerMode: true,
          slidesToShow: 2
        }
      },
      {
        breakpoint: 576,
        settings: {
          centerMode: true,
          slidesToShow: 1
        }
      }
    ]
  });

  // Progress bar update
  $slider.on('init reInit afterChange', function (event, slick, currentSlide) {
    var i = (currentSlide ? currentSlide : 0) + 1;
    var percent = (i / slick.slideCount) * 100;
    $progressLine.css('width', percent + '%');
  });

  // ===== Partners Slider =====
  $('.partners .our-clients').slick({
    slidesToShow: 9,
    slidesToScroll: 3,
    infinite: true,
    autoplay: true,
    speed: 1000,
    arrows: false,
    dots: true,
    rtl: check_rtl,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 6,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });

  // ===== Hero Slider =====
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
    touchMove: true
  });

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
