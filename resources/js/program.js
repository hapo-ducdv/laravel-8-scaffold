$(function () {
  function baseAjaxSetup(type, link, data, dataType) {
    $.ajaxSetup({
      type: type,
      url: link,
      data: data,
      dataType: dataType,
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      }
    });
  }

  $('.btn-preview').click(function() {
    var ajaxSetup = baseAjaxSetup(
      'post',
      '/programs/join',
      {programId: $(this).data('program-id')},
      'json'
    );

    $.ajax({
      success: function (response) {
        $('#progressBar').css('width', response.progress + '%');
        $('#progressNumber').html(response.progress + '%');
      }
    })

    $(this).html('Previewed');
  });
});
