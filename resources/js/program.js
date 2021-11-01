$(function () {
  $('.btn-preview').click(function() {
    $.ajax({
      type: 'post',
      url: '/programs/join',
      data: {programId: $(this).data('program-id')},
      dataType: 'json',
      success: function (response) {
        $('#progressBar').css('width', response.progress + '%');
        $('#progressNumber').html(response.progress + '%');
      }
    })

    $(this).html('Previewed');
  });
});
