! function (a) {
  var b = function () {
    this.$body = a("body");
    this.$realData = []
  };
  b.prototype.createPlotGraph = function (i, f, g, h, e, d, c) {
    function j(l, m, k) {
      a('<div id="tooltip" class="tooltipflot">' + k + "</div>").css({
        position: "absolute",
        top: m + 5,
        left: l + 5
      }).appendTo("body").fadeIn(200)
    }
    a.plot(a(i), [{
      data: f,
      label: h[0],
      color: e[0]
    }, {
      data: g,
      label: h[1],
      color: e[1]
    }], {
      series: {
        lines: {
          show: true,
          fill: true,
          lineWidth: 1,
          fillColor: {
            colors: [{
              opacity: 0
            }, {
              opacity: 0.7
            }]
          }
        },
        points: {
          show: true
        },
        shadowSize: 0
      },
      legend: {
        position: "nw"
      },
      grid: {
        hoverable: true,
        clickable: true,
        borderColor: d,
        borderWidth: 0,
        labelMargin: 10,
        backgroundColor: c
      },
      yaxis: {
        min: 0,
        max: 15,
        color: "rgba(0,0,0,0)"
      },
      xaxis: {
        color: "rgba(0,0,0,0)"
      },
      tooltip: true,
      tooltipOpts: {
        content: "%s: Value of %x is %y",
        shifts: {
          x: -60,
          y: 25
        },
        defaultTheme: false
      }
    })
  }, b.prototype.createPieGraph = function (h, f, e, c) {
    var d = [{
      label: f[0],
      data: e[0]
    }, {
      label: f[1],
      data: e[1]
    }, {
      label: f[2],
      data: e[2]
    }];
    var g = {
      series: {
        pie: {
          show: true
        }
      },
      legend: {
        show: false
      },
      grid: {
        hoverable: true,
        clickable: true
      },
      colors: c,
      tooltip: true,
      tooltipOpts: {
        defaultTheme: false
      }
    };
    a.plot(a(h), d, g)
  }, b.prototype.init = function () {
    var k = [
      [0, 9],
      [1, 8],
      [2, 5],
      [3, 8],
      [4, 5],
      [5, 14],
      [6, 10]
    ];
    var g = [
      [0, 5],
      [1, 12],
      [2, 4],
      [3, 3],
      [4, 12],
      [5, 11],
      [6, 14]
    ];
    var j = ["Visits", "Pages/Visit"];
    var h = ["#317eeb", "#29b6f6"];
    var d = "#fff";
    var c = "#fff";
    this.createPlotGraph("#website-stats", k, g, j, h, d, c);
    var i = ["Series 1", "Series 2", "Series 3"];
    var f = [20, 30, 20];
    var e = ["rgba(30, 136, 229, 0.7)", "rgba(41, 182, 246, 0.7)", "rgba(126, 87, 194, 0.7)"];
    this.createPieGraph("#pie-chart #pie-chart-container", i, f, e)
  }, a.Dashboard = new b, a.Dashboard.Constructor = b
}(window.jQuery),
function (a) {
  a.Dashboard.init()
}(window.jQuery);
