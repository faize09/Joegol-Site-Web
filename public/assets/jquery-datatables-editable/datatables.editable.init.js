(function (a) {
  var b = {
    options: {
      addButton: "#addToTable",
      table: "#datatable-editable",
      dialog: {
        wrapper: "#dialog",
        cancelButton: "#dialogCancel",
        confirmButton: "#dialogConfirm",
      }
    },
    initialize: function () {
      this.setVars().build().events()
    },
    setVars: function () {
      this.$table = a(this.options.table);
      this.$addButton = a(this.options.addButton);
      this.dialog = {};
      this.dialog.$wrapper = a(this.options.dialog.wrapper);
      this.dialog.$cancel = a(this.options.dialog.cancelButton);
      this.dialog.$confirm = a(this.options.dialog.confirmButton);
      return this
    },
    build: function () {
      this.datatable = this.$table.DataTable({
        aoColumns: [null,null, null, null, null, {
          bSortable: false
        }]
      });
      window.dt = this.datatable;
      return this
    },
    events: function () {
      var c = this;
      this.$table.on("click", "a.save-row", function (d) {
        d.preventDefault();
        c.rowSave(a(this).closest("tr"))
      }).on("click", "a.cancel-row", function (d) {
        d.preventDefault();
        c.rowCancel(a(this).closest("tr"))
      }).on("click", "a.edit-row", function (d) {
        d.preventDefault();
        c.rowEdit(a(this).closest("tr"))
      }).on("click", "a.remove-row", function (f) {
        f.preventDefault();
        var d = a(this).closest("tr");
        a.magnificPopup.open({
          items: {
            src: c.options.dialog.wrapper,
            type: "inline"
          },
          preloader: false,
          modal: true,
          callbacks: {
            change: function () {
              c.dialog.$confirm.on("click", function (g) {
                g.preventDefault();
                c.rowRemove(d);
                a.magnificPopup.close()
              })
            },
            close: function () {
              c.dialog.$confirm.off("click")
            }
          }
        })
      });
      this.$addButton.on("click", function (d) {
        d.preventDefault();
        c.rowAdd()
      });
      this.dialog.$cancel.on("click", function (d) {
        d.preventDefault();
        a.magnificPopup.close()
      });
      return this
    },
    rowAdd: function () {
      this.$addButton.attr({
        disabled: "disabled"
      });
      var d, e, c;
      d = ['<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>', '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>', '<a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>', '<a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>'].join(" ");
      e = this.datatable.row.add(["","","", "", "", d]);
      c = this.datatable.row(e[0]).nodes().to$();
      c.addClass("adding").find("td:last").addClass("actions");
      this.rowEdit(c);
      this.datatable.order([0, "asc"]).draw()
    },
    rowCancel: function (d) {
      var e = this,
        c, g, f;
      if (d.hasClass("adding")) {
        this.rowRemove(d)
      } else {
        f = this.datatable.row(d.get(0)).data();
        this.datatable.row(d.get(0)).data(f);
        c = d.find("td.actions");
        if (c.get(0)) {
          this.rowSetActionsDefault(d)
        }
        this.datatable.draw()
      }
    },
    rowEdit: function (c) {
      var d = this,
        e;
      e = this.datatable.row(c.get(0)).data();
      c.children("td").each(function (g) {
        var f = a(this);
        if (f.hasClass("actions")) {
          d.rowSetActionsEditing(c)
        } else {
          f.html('<input type="text" class="form-control input-block" value="' + e[g] + '"/>')
        }
      })
    },
    rowSave: function (d) {
      var e = this,
        c, f = [];
      if (d.hasClass("adding")) {
        this.$addButton.removeAttr("disabled");
        d.removeClass("adding")
      }
      f = d.find("td").map(function () {
        var g = a(this);
        if (g.hasClass("actions")) {
          e.rowSetActionsDefault(d);
          return e.datatable.cell(this).data()
        } else {
          return a.trim(g.find("input").val())
        }
      });
      this.datatable.row(d.get(0)).data(f);
      c = d.find("td.actions");
      if (c.get(0)) {
        this.rowSetActionsDefault(d)
      }
      this.datatable.draw()
    },
    rowRemove: function (c) {
      if (c.hasClass("adding")) {
        this.$addButton.removeAttr("disabled")
      }
      this.datatable.row(c.get(0)).remove().draw()
    },
    rowSetActionsEditing: function (c) {
      c.find(".on-editing").removeClass("hidden");
      c.find(".on-default").addClass("hidden")
    },
    rowSetActionsDefault: function (c) {
      c.find(".on-editing").addClass("hidden");
      c.find(".on-default").removeClass("hidden")
    }
  };
  a(function () {
    b.initialize()
  })
}).apply(this, [jQuery]);
