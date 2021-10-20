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

  $('#tags').select2({
    placeholder: "Tags"
  });

  $('#teacher').select2({
    placeholder: "Teachers"
  });

  $("#icon-upload-avatar").click(function () {
    $("#input-upload-avatar").trigger('click');
  });

  $("#profile-avatar").click(function () {
    $("#input-upload-avatar").trigger('click');
  });

  $('.message-sesson').delay(5000).fadeOut();

  $("#btn-edit-profile").click(function () {
    $('.input-update-profile').prop('disabled', false);
    $('#btn-update-profile').prop('hidden', false);
    $('#btn-edit-profile').prop('hidden', true);
  });

  if ($('#pills-review-tab').hasClass('show-pills-tab')) {
    $('#pills-tab .show-pills-tab').tab('show');
  }

  $("ul.nav-pills > li > a").on("shown.bs.tab", function (e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
  });

  var hash = window.location.hash;

  $('#pills-tab a[href="' + hash + '"]').tab('show');

});
