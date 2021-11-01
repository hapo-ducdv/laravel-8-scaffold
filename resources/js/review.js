$(function () {
  $("ul.nav-pills > li > a").on("shown.bs.tab", function (e) {
    var scrollHeight = $(document).scrollTop();

    setTimeout(function() {
      $(window).scrollTop(scrollHeight );
    }, 5);

    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
  });

  var hash = window.location.hash;

  $('#pillsTab a[href="' + hash + '"]').tab('show');
});
