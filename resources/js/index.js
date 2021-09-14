$(function () {
  let n = 0;

  $('#navbar-toggler').click(function() {
    if (n == 0) {
      $('#icon-navbar-toggler').removeClass('fa-bars').addClass('fa-times');
      $('.cih').hide();
      n = 1;
    } else {
      $('#icon-navbar-toggler').removeClass('fa-times').addClass('fa-bars');
      $('.cih').show();
      n = 0;
    }
  });

  $('#feedback-slide').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 1,
    prevArrow: '<button class="slide-arrow prev-arrow"><i class="fas fa-angle-left"></i></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><i class="fas fa-angle-right"></i></button>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      }
    ]
  });

  $('#btn-close-msg').click(function() {
    $('#messenger-show').slideUp();
  });

  $('#logo-messenger').click(function() {
    $('#messenger-show').slideDown();
  });
});
