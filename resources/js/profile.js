$(function () {
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
});
