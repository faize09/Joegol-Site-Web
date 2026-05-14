! function (a) {
  var b = function () {
    this.$body = a("body"), this.$openLeftBtn = a(".open-left"), this.$menuItem = a("#sidebar-menu a")
  };
  b.prototype.openLeftBar = function () {
    a("#wrapper").toggleClass("enlarged");
    a("#wrapper").addClass("forced");
    if (a("#wrapper").hasClass("enlarged") && a("body").hasClass("fixed-left")) {
      a("body").removeClass("fixed-left").addClass("fixed-left-void")
    } else {
      if (!a("#wrapper").hasClass("enlarged") && a("body").hasClass("fixed-left-void")) {
        a("body").removeClass("fixed-left-void").addClass("fixed-left")
      }
    }
    if (a("#wrapper").hasClass("enlarged")) {
      a(".left ul").removeAttr("style")
    } else {
      a(".subdrop").siblings("ul:first").show()
    }
    toggle_slimscroll(".slimscrollleft");
    a("body").trigger("resize")
  }, b.prototype.menuItemClick = function (c) {
    if (!a("#wrapper").hasClass("enlarged")) {
      if (a(this).parent().hasClass("has_sub")) {
        c.preventDefault()
      }
      if (!a(this).hasClass("subdrop")) {
        a("ul", a(this).parents("ul:first")).slideUp(350);
        a("a", a(this).parents("ul:first")).removeClass("subdrop");
        a("#sidebar-menu .pull-right i").removeClass("md-remove").addClass("md-add");
        a(this).next("ul").slideDown(350);
        a(this).addClass("subdrop");
        a(".pull-right i", a(this).parents(".has_sub:last")).removeClass("md-add").addClass("md-remove");
        a(".pull-right i", a(this).siblings("ul")).removeClass("md-remove").addClass("md-add")
      } else {
        if (a(this).hasClass("subdrop")) {
          a(this).removeClass("subdrop");
          a(this).next("ul").slideUp(350);
          a(".pull-right i", a(this).parent()).removeClass("md-remove").addClass("md-add")
        }
      }
    }
  }, b.prototype.init = function () {
    var c = this;
    a(".open-left").click(function (d) {
      d.stopPropagation();
      c.openLeftBar()
    });
    c.$menuItem.on("click", c.menuItemClick);
    a("#sidebar-menu ul li.has_sub a.active").parents("li:last").children("a:first").addClass("active").trigger("click")
  }, a.Sidemenu = new b, a.Sidemenu.Constructor = b
}(window.jQuery),
function (a) {
  var b = function () {
    this.$body = a("body"), this.$fullscreenBtn = a("#btn-fullscreen")
  };
  b.prototype.launchFullscreen = function (c) {
    if (c.requestFullscreen) {
      c.requestFullscreen()
    } else {
      if (c.mozRequestFullScreen) {
        c.mozRequestFullScreen()
      } else {
        if (c.webkitRequestFullscreen) {
          c.webkitRequestFullscreen()
        } else {
          if (c.msRequestFullscreen) {
            c.msRequestFullscreen()
          }
        }
      }
    }
  }, b.prototype.exitFullscreen = function () {
    if (document.exitFullscreen) {
      document.exitFullscreen()
    } else {
      if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen()
      } else {
        if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen()
        }
      }
    }
  }, b.prototype.toggle_fullscreen = function () {
    var c = this;
    var d = document.fullscreenEnabled || document.mozFullScreenEnabled || document.webkitFullscreenEnabled;
    if (d) {
      if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
        c.launchFullscreen(document.documentElement)
      } else {
        c.exitFullscreen()
      }
    }
  }, b.prototype.init = function () {
    var c = this;
    c.$fullscreenBtn.on("click", function () {
      c.toggle_fullscreen()
    })
  }, a.FullScreen = new b, a.FullScreen.Constructor = b
}(window.jQuery),
function (a) {
  var b = function () {
    this.$body = a("body"), this.$portletIdentifier = ".portlet", this.$portletCloser = '.portlet a[data-toggle="remove"]', this.$portletRefresher = '.portlet a[data-toggle="reload"]'
  };
  b.prototype.init = function () {
    var c = this;
    a(document).on("click", this.$portletCloser, function (f) {
      f.preventDefault();
      var d = a(this).closest(c.$portletIdentifier);
      var e = d.parent();
      d.remove();
      if (e.children().length == 0) {
        e.remove()
      }
    });
    a(document).on("click", this.$portletRefresher, function (f) {
      f.preventDefault();
      var e = a(this).closest(c.$portletIdentifier);
      e.append('<div class="panel-disabled"><div class="loader-1"></div></div>');
      var d = e.find(".panel-disabled");
      setTimeout(function () {
        d.fadeOut("fast", function () {
          d.remove()
        })
      }, 500 + 300 * (Math.random() * 5))
    })
  }, a.Portlet = new b, a.Portlet.Constructor = b
}(window.jQuery),
function (a) {
  var b = function () {
    this.VERSION = "1.0.0", this.AUTHOR = "Coderthemes", this.SUPPORT = "coderthemes@gmail.com", this.pageScrollElement = "html, body", this.$body = a("body")
  };
  b.prototype.initTooltipPlugin = function () {
    a.fn.tooltip && a('[data-toggle="tooltip"]').tooltip()
  }, b.prototype.initPopoverPlugin = function () {
    a.fn.popover && a('[data-toggle="popover"]').popover()
  }, b.prototype.initNiceScrollPlugin = function () {
    a.fn.niceScroll && a(".nicescroll").niceScroll({
      cursorcolor: "#9d9ea5",
      cursorborderradius: "0px"
    })
  }, b.prototype.initKnob = function () {
    if (a(".knob").length > 0) {
      a(".knob").knob()
    }
  }, b.prototype.onDocReady = function (c) {
    FastClick.attach(document.body);
    resizefunc.push("initscrolls");
    resizefunc.push("changeptype");
    a(".animate-number").each(function () {
      a(this).animateNumbers(a(this).attr("data-value"), true, parseInt(a(this).attr("data-duration")))
    });
    a(window).resize(debounce(resizeitems, 100));
    a("body").trigger("resize");
    a(".right-bar-toggle").on("click", function (d) {
      d.preventDefault();
      a("#wrapper").toggleClass("right-bar-enabled")
    })
  }, b.prototype.init = function () {
    var c = this;
    this.initTooltipPlugin(), this.initPopoverPlugin(), this.initNiceScrollPlugin(), this.initKnob(), a(document).ready(c.onDocReady);
    a.Portlet.init();
    a.Sidemenu.init();
    a.FullScreen.init()
  }, a.MoltranApp = new b, a.MoltranApp.Constructor = b
}(window.jQuery),
function (a) {
  a.MoltranApp.init()
}(window.jQuery);
var toggle_fullscreen = function () {};

function executeFunctionByName(d, b) {
  var a = [].slice.call(arguments).splice(2);
  var f = d.split(".");
  var c = f.pop();
  for (var e = 0; e < f.length; e++) {
    b = b[f[e]]
  }
  return b[c].apply(this, a)
}
var w, h, dw, dh;
var changeptype = function () {
  w = $(window).width();
  h = $(window).height();
  dw = $(document).width();
  dh = $(document).height();
  if (jQuery.browser.mobile === true) {
    $("body").addClass("mobile").removeClass("fixed-left")
  }
  if (!$("#wrapper").hasClass("forced")) {
    if (w > 990) {
      $("body").removeClass("smallscreen").addClass("widescreen");
      $("#wrapper").removeClass("enlarged")
    } else {
      $("body").removeClass("widescreen").addClass("smallscreen");
      $("#wrapper").addClass("enlarged");
      $(".left ul").removeAttr("style")
    }
    if ($("#wrapper").hasClass("enlarged") && $("body").hasClass("fixed-left")) {
      $("body").removeClass("fixed-left").addClass("fixed-left-void")
    } else {
      if (!$("#wrapper").hasClass("enlarged") && $("body").hasClass("fixed-left-void")) {
        $("body").removeClass("fixed-left-void").addClass("fixed-left")
      }
    }
  }
  toggle_slimscroll(".slimscrollleft")
};
var debounce = function (a, e, b) {
  var d, c;
  return function () {
    var j = this,
      f = arguments;
    var k = function () {
      d = null;
      if (!b) {
        c = a.apply(j, f)
      }
    };
    var g = b && !d;
    clearTimeout(d);
    d = setTimeout(k, e);
    if (g) {
      c = a.apply(j, f)
    }
    return c
  }
};

function resizeitems() {
  if ($.isArray(resizefunc)) {
    for (i = 0; i < resizefunc.length; i++) {
      window[resizefunc[i]]()
    }
  }
}

function initscrolls() {
  if (jQuery.browser.mobile !== true) {
    $(".slimscroller").slimscroll({
      height: "auto",
      size: "5px"
    });
    $(".slimscrollleft").slimScroll({
      height: "auto",
      position: "right",
      size: "5px",
      color: "#7A868F",
      wheelStep: 5
    })
  }
}

function toggle_slimscroll(a) {
  if ($("#wrapper").hasClass("enlarged")) {
    $(a).css("overflow", "inherit").parent().css("overflow", "inherit");
    $(a).siblings(".slimScrollBar").css("visibility", "hidden")
  } else {
    $(a).css("overflow", "hidden").parent().css("overflow", "hidden");
    $(a).siblings(".slimScrollBar").css("visibility", "visible")
  }
}
var wow = new WOW({
  boxClass: "wow",
  animateClass: "animated",
  offset: 50,
  mobile: false
});
wow.init();
