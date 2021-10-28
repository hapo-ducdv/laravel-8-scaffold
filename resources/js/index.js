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

  $('#closeMsg').click(function() {
    $('#messengerShow').slideUp();
  });

  $('.logo-messenger').click(function() {
    $('#messengerShow').slideDown();
  });

  if ($('.register-invalid').hasClass('is-invalid')) {
    $('#modalLoginRegister').modal('show');
    $('#registerTab').tab('show');
  }

  if ($('#modalLogin').hasClass('show-modal-login')) {
    $('#modalLoginRegister').modal('show');
  }

  $('#tags').select2({
    placeholder: "Tags"
  });

  $('#teacher').select2({
    placeholder: "Teachers"
  });

  $("#iconUploadAvatar").click(function () {
    $(".input-upload-avatar").trigger('click');
  });

  $("#profileAvatar").click(function () {
    $(".input-upload-avatar").trigger('click');
  });

  $('.message-sesson').delay(5000).fadeOut();

  $("#editProfile").click(function () {
    $('.input-update-profile').prop('disabled', false);
    $('#updateProfile').prop('hidden', false);
    $('#editProfile').prop('hidden', true);
  });

  $("ul.nav-pills > li > a").on("shown.bs.tab", function (e) {
    let scrollHeight = $(document).scrollTop();
    setTimeout(function() {
      $(window).scrollTop(scrollHeight );
    }, 5);
    let id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
  });

  var hash = window.location.hash;

  $('#pillsTab a[href="' + hash + '"]').tab('show');

  $('.btn-preview').click(function() {
    $.ajax({
      type: 'post',
      url: '/programs/join',
      data: {
        programId: $(this).data('program-id'),
      },
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
      success: function (response) {
        $('#progressBar').css('width', response.progress + '%');
        $('#progressNumber').html(response.progress + '%');
      }
    })
    $(this).html('Previewed');
  });
});
