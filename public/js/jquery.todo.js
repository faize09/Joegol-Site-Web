! function (a) {
  var b = function () {
    this.$body = a("body"), this.$todoContainer = a("#todo-container"), this.$todoMessage = a("#todo-message"), this.$todoRemaining = a("#todo-remaining"), this.$todoTotal = a("#todo-total"), this.$archiveBtn = a("#btn-archive"), this.$todoList = a("#todo-list"), this.$todoDonechk = ".todo-done", this.$todoForm = a("#todo-form"), this.$todoInput = a("#todo-input-text"), this.$todoBtn = a("#todo-btn-submit"), this.$todoData = [{
      id: "1",
      text: "Design One page theme",
      done: false
    }, {
      id: "2",
      text: "Build a js based app",
      done: true
    }, {
      id: "3",
      text: "Creating component page",
      done: true
    }, {
      id: "4",
      text: "Testing??",
      done: true
    }, {
      id: "5",
      text: "Hehe!! This is looks cool!",
      done: false
    }, {
      id: "6",
      text: "Build an angular app",
      done: true
    }];
    this.$todoCompletedData = [];
    this.$todoUnCompletedData = []
  };
  b.prototype.markTodo = function (e, c) {
    for (var d = 0; d < this.$todoData.length; d++) {
      if (this.$todoData[d].id == e) {
        this.$todoData[d].done = c
      }
    }
  }, b.prototype.addTodo = function (c) {
    this.$todoData.push({
      id: this.$todoData.length,
      text: c,
      done: false
    });
    this.generate()
  }, b.prototype.archives = function () {
    this.$todoUnCompletedData = [];
    for (var c = 0; c < this.$todoData.length; c++) {
      var d = this.$todoData[c];
      if (d.done == true) {
        this.$todoCompletedData.push(d)
      } else {
        this.$todoUnCompletedData.push(d)
      }
    }
    this.$todoData = [];
    this.$todoData = [].concat(this.$todoUnCompletedData);
    this.generate()
  }, b.prototype.generate = function () {
    this.$todoList.html("");
    var d = 0;
    for (var c = 0; c < this.$todoData.length; c++) {
      var e = this.$todoData[c];
      if (e.done == true) {
        this.$todoList.prepend('<li class="list-group-item"><div class="checkbox checkbox-primary"><input class="todo-done" id="' + e.id + '" type="checkbox" checked><label for="' + e.id + '">' + e.text + "</label></div></li>")
      } else {
        d = d + 1;
        this.$todoList.prepend('<li class="list-group-item"><div class="checkbox checkbox-primary"><input class="todo-done" id="' + e.id + '" type="checkbox"><label for="' + e.id + '">' + e.text + "</label></div></li>")
      }
    }
    this.$todoTotal.text(this.$todoData.length);
    this.$todoRemaining.text(d)
  }, b.prototype.init = function () {
    var c = this;
    this.generate();
    this.$archiveBtn.on("click", function (d) {
      d.preventDefault();
      c.archives();
      return false
    });
    a(document).on("change", this.$todoDonechk, function () {
      if (this.checked) {
        c.markTodo(a(this).attr("id"), true)
      } else {
        c.markTodo(a(this).attr("id"), false)
      }
      c.generate()
    });
    this.$todoBtn.on("click", function () {
      if (c.$todoInput.val() == "" || typeof (c.$todoInput.val()) == "undefined" || c.$todoInput.val() == null) {
        sweetAlert("Oops...", "You forgot to enter todo text", "error");
        c.$todoInput.focus()
      } else {
        c.addTodo(c.$todoInput.val())
      }
    })
  }, a.TodoApp = new b, a.TodoApp.Constructor = b
}(window.jQuery),
function (a) {
  a.TodoApp.init()
}(window.jQuery);
