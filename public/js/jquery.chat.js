! function (a) {
  var b = function () {
    this.$body = a("body"), this.$chatInput = a(".chat-input"), this.$chatList = a(".conversation-list"), this.$chatSendBtn = a(".chat-send .btn")
  };
  b.prototype.save = function () {
    var c = this.$chatInput.val();
    var d = moment().format("h:mm");
    if (c == "") {
      sweetAlert("Oops...", "You forgot to enter your chat message", "error");
      this.$chatInput.focus()
    } else {
      a('<li class="clearfix"><div class="chat-avatar"><img src="images/avatar-1.jpg" alt="male"><i>' + d + '</i></div><div class="conversation-text"><div class="ctext-wrap"><i>John Deo</i><p>' + c + "</p></div></div></li>").appendTo(".conversation-list");
      this.$chatInput.val("");
      this.$chatInput.focus();
      this.$chatList.scrollTo("100%", "100%", {
        easing: "swing"
      })
    }
  }, b.prototype.init = function () {
    var c = this;
    c.$chatInput.keypress(function (d) {
      var e = d.which;
      if (e == 13) {
        c.save();
        return false
      }
    });
    c.$chatSendBtn.click(function (d) {
      c.save();
      return false
    })
  }, a.ChatApp = new b, a.ChatApp.Constructor = b
}(window.jQuery),
function (a) {
  a.ChatApp.init()
}(window.jQuery);
