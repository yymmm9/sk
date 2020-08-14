jQuery(function($) {
  "use strict";

  var win = $(window),
    target = $("body"),
    wrapper = target.find("> main"),
    parI = $(".par--1"),
    parII = $(".par--2"),
    easing = "cubic-bezier(.31,.69,.41,.96)", //css easing
    duration = ".7s", //duration ms(millisecond) or s(second)
    top = 0,
    kineticScroll = {
      _init: function() {
        if (wrapper.length == 1) {
          target.height(wrapper.height());
          wrapper.css({
            transition: "transform " + duration + " " + easing,
            position: "fixed",
            top: "0",
            left: "0",
            width: "100%",
            padding: "0",
            zIndex: "2"
          });
          parI.css({
            transition: "transform " + duration + " " + easing
          });
          parII.css({
            transition: "transform " + duration + " " + easing
          });

          win.on({
            scroll: function() {
              kineticScroll._scroll();
            },
            resize: function() {
              target.height(wrapper.outerHeight());
            }
          });

          kineticScroll._scroll();
        }
      },
      _scroll: function() {
        top = win.scrollTop();
        wrapper.css("transform", "translateY(-" + top + "px)");
        parI.css("transform", "translateY(-" + top / 3 + "px)");
        parII.css("transform", "translateY(-" + top / 5 + "px)");
      }
    };

  if (typeof window.ontouchstart == "undefined") {
    kineticScroll._init();
  } else {
    var parI = $(".par--1"),
      parII = $(".par--2"),
      $body = $("body"),
      bodyHeight = $body.height();

    function getScrollTop() {
      if (typeof pageYOffset != "undefined") {
        //most browsers except IE before #9
        return pageYOffset;
      } else {
        var B = document.body; //IE 'quirks'
        var D = document.documentElement; //IE with doctype
        D = D.clientHeight ? D : B;
        return D.scrollTop;
      }
      return false;
    }

    $(window).scroll(function() {
      var scroll = getScrollTop();
      var xnN = scroll * -0.3;
      var xpN = scroll * -0.5;

      gsap.to(".par--1", {
        translateY: xnN,
        duration: 0.4,
        ease: "easeOutQuart"
      });
      gsap.to(".par--2", {
        translateY: xpN,
        duration: 0.7,
        ease: "easeOutQuart"
      });
    });
  }
});