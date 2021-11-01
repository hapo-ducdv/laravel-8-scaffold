$(function () {
  $('#navbarToggler').click(function() {
    if ($('#iconNavbarToggler').hasClass('fa-bars')) {
      $('#iconNavbarToggler').removeClass('fa-bars').addClass('fa-times');
      $('.cih').hide();
    } else {
      $('#iconNavbarToggler').removeClass('fa-times').addClass('fa-bars');
      $('.cih').show();
    }
  });

  $('#feedbackSlide').slick({
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
});
