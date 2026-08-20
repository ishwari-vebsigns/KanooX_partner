(function($) {
    "use strict";

    // Morris bar chart - only run if the container exists on this page
    if (document.getElementById('morris-bar-chart') && window.Morris) {
        Morris.Bar({
            element: 'morris-bar-chart',
            data: [{
                y: '2006',
                a: 100,
                b: 90
            }, {
                y: '2007',
                a: 75,
                b: 65
            }, {
                y: '2008',
                a: 50,
                b: 40
            }, {
                y: '2009',
                a: 75,
                b: 65
            }, {
                y: '2010',
                a: 50,
                b: 40
            }, {
                y: '2011',
                a: 75,
                b: 65
            }, {
                y: '2012',
                a: 100,
                b: 90
            }],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['A', 'B'],
            barColors: ['#343957', '#5873FE'],
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            resize: true
        });
    }

    if ($('#info-circle-card').length && $.fn.circleProgress) {
        $('#info-circle-card').circleProgress({
            value: 0.70,
            size: 100,
            fill: {
                gradient: ["#a389d5"]
            }
        });
    }

    if ($('.testimonial-widget-one .owl-carousel').length && $.fn.owlCarousel) {
        $('.testimonial-widget-one .owl-carousel').owlCarousel({
            singleItem: true,
            loop: true,
            autoplay: false,
            autoplayTimeout: 2500,
            autoplayHoverPause: true,
            margin: 10,
            nav: false,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    if ($('#vmap13').length && $.fn.vectorMap) {
        $('#vmap13').vectorMap({
            map: 'usa_en',
            backgroundColor: 'transparent',
            borderColor: 'rgb(88, 115, 254)',
            borderOpacity: 0.25,
            borderWidth: 1,
            color: 'rgb(88, 115, 254)',
            enableZoom: true,
            hoverColor: 'rgba(88, 115, 254)',
            hoverOpacity: null,
            normalizeFunction: 'linear',
            scaleColors: ['#b6d6ff', '#005ace'],
            selectedColor: 'rgba(88, 115, 254, 0.9)',
            selectedRegions: null,
            showTooltip: true
        });
    }

    var nk = document.getElementById("sold-product");
    if (nk && window.Chart) {
        new Chart(nk, {
            type: 'pie',
            data: {
                defaultFontFamily: 'Poppins',
                datasets: [{
                    data: [45, 25, 20, 10],
                    borderWidth: 0,
                    backgroundColor: [
                        "rgba(89, 59, 219, .9)",
                        "rgba(89, 59, 219, .7)",
                        "rgba(89, 59, 219, .5)",
                        "rgba(89, 59, 219, .07)"
                    ],
                    hoverBackgroundColor: [
                        "rgba(89, 59, 219, .9)",
                        "rgba(89, 59, 219, .7)",
                        "rgba(89, 59, 219, .5)",
                        "rgba(89, 59, 219, .07)"
                    ]

                }],
                labels: [
                    "one",
                    "two",
                    "three",
                    "four"
                ]
            },
            options: {
                responsive: true,
                legend: false,
                maintainAspectRatio: false
            }
        });
    }

})(jQuery);

(function($) {
    "use strict";

    // Only run the flot "cpu-load" demo chart if its container exists
    if (!$('#cpu-load').length || !$.plot) {
        return;
    }

    var data = [],
        totalPoints = 300;

    function getRandomData() {

        if (data.length > 0)
            data = data.slice(1);

        // Do a random walk

        while (data.length < totalPoints) {

            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5;

            if (y < 0) {
                y = 0;
            } else if (y > 100) {
                y = 100;
            }

            data.push(y);
        }

        // Zip the generated y values with the x values

        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
        }

        return res;
    }

    // Set up the control widget

    var updateInterval = 30;
    $("#updateInterval").val(updateInterval).change(function() {
        var v = $(this).val();
        if (v && !isNaN(+v)) {
            updateInterval = +v;
            if (updateInterval < 1) {
                updateInterval = 1;
            } else if (updateInterval > 3000) {
                updateInterval = 3000;
            }
            $(this).val("" + updateInterval);
        }
    });

    var plot = $.plot("#cpu-load", [getRandomData()], {
        series: {
            shadowSize: 0 // Drawing is faster without shadows
        },
        yaxis: {
            min: 0,
            max: 100
        },
        xaxis: {
            show: false
        },
        colors: ["#007BFF"],
        grid: {
            color: "transparent",
            hoverable: true,
            borderWidth: 0,
            backgroundColor: 'transparent'
        },
        tooltip: true,
        tooltipOpts: {
            content: "Y: %y",
            defaultTheme: false
        }


    });

    function update() {

        plot.setData([getRandomData()]);

        // Since the axes don't change, we don't need to call plot.setupGrid()

        plot.draw();
        setTimeout(update, updateInterval);
    }

    update();


})(jQuery);

// Guard PerfectScrollbar init too, in case these widgets aren't on every page
if (document.querySelector('.widget-todo') && window.PerfectScrollbar) {
    const wt = new PerfectScrollbar('.widget-todo');
}
if (document.querySelector('.widget-timeline') && window.PerfectScrollbar) {
    const wtl = new PerfectScrollbar('.widget-timeline');
}