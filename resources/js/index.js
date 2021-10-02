$(function () {
  $('#navbar-toggler').click(function() {
    if ($('#icon-navbar-toggler').hasClass('fa-bars')) {
      $('#icon-navbar-toggler').removeClass('fa-bars').addClass('fa-times');
      $('.cih').hide();
    } else {
      $('#icon-navbar-toggler').removeClass('fa-times').addClass('fa-bars');
      $('.cih').show();
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

  if ($('.register-invalid').hasClass('is-invalid') || $('#modal-register').hasClass('show-modal-register')) {
    $('#modalLoginRegister').modal('show');
    $('#register-tab').tab('show');
  }

  if ($('#modal-login').hasClass('show-modal-login')) {
    $('#modalLoginRegister').modal('show');
  }

  $('.js-example-basic-multiple').select2();

  $('#tags').select2({
    placeholder: "Tags"
  });

  $('#teacher').select2({
    placeholder: "Teachers"
  });
});
