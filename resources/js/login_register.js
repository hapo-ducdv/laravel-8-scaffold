$(function () {
  if ($('.register-invalid').hasClass('is-invalid')) {
    $('#modalLoginRegister').modal('show');
    $('#registerTab').tab('show');
  }

  if ($('#modalLogin').hasClass('show-modal-login')) {
    $('#modalLoginRegister').modal('show');
  }
});
