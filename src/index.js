$( document ).ready(function() {
  $("#toggle").click(function() {
    $(this).toggleClass("active");
    $(".overlay").toggleClass("open");
    $("body").toggleClass("no-scroll");
  });

  $("#scroll-to-bottom").click( function() {
    $("html, body").animate({ scrollTop: $("footer").offset().top }, 500);
    $(".overlay").removeClass("open");
    $("#toggle").removeClass("active");
  });
});

