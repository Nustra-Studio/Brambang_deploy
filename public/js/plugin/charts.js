class Charts {
    constructor() {
        "undefined" != typeof Chart ? (this._lineChart = null,
        this._areaChart = null,
        this._scatterChart = null,
        this._radarChart = null,
        this._polarChart = null,
        this._pieChart = null,
        this._doughnutChart = null,
        this._barChart = null,
        this._horizontalBarChart = null,
        this._bubbleChart = null,
        this._roundedBarChart = null,
        this._horizontalRoundedBarChart = null,
        this._streamingLineChart = null,
        this._streamingBarChart = null,
        this._customTooltipDoughnut = null,
        this._customTooltipBar = null,
        this._customLegendBar = null,
        this._customLegendDoughnut = null,
        this._smallDoughnutChart1 = null,
        this._smallDoughnutChart2 = null,
        this._smallDoughnutChart3 = null,
        this._smallDoughnutChart4 = null,
        this._smallDoughnutChart5 = null,
        this._smallDoughnutChart6 = null,
        this._smallLineChart1 = null,
        this._smallLineChart2 = null,
        this._smallLineChart3 = null,
        this._smallLineChart4 = null,
        this._initLineChart(),
        this._initAreaChart(),
        this._initScatterChart(),
        this._initRadarChart(),
        this._initPolarChart(),
        this._initPieChart(),
        this._initDoughnutChart(),
        this._initBarChart(),
        this._initHorizontalBarChart(),
        this._initBubbleChart(),
        this._initRoundedBarChart(),
        this._initHorizontalRoundedBarChart(),
        this._initStreamingLineChart(),
        this._initStreamingBarChart(),
        this._initCustomTooltipDoughnut(),
        this._initCustomTooltipBar(),
        this._initCustomLegendBar(),
        this._initCustomLegendDoughnut(),
        this._initSmallDoughnutCharts(),
        this._initSmallLineCharts(),
        this._initEvents()) : console.log("Chart is undefined!")
    }
    _initEvents() {
        document.documentElement.addEventListener(Globals.colorAttributeChange, (t=>{
            this._lineChart && this._lineChart.destroy(),
            this._initLineChart(),
            this._areaChart && this._areaChart.destroy(),
            this._initAreaChart(),
            this._scatterChart && this._scatterChart.destroy(),
            this._initScatterChart(),
            this._radarChart && this._radarChart.destroy(),
            this._initRadarChart(),
            this._polarChart && this._polarChart.destroy(),
            this._initPolarChart(),
            this._pieChart && this._pieChart.destroy(),
            this._initPieChart(),
            this._doughnutChart && this._doughnutChart.destroy(),
            this._initDoughnutChart(),
            this._barChart && this._barChart.destroy(),
            this._initBarChart(),
            this._horizontalBarChart && this._horizontalBarChart.destroy(),
            this._initHorizontalBarChart(),
            this._bubbleChart && this._bubbleChart.destroy(),
            this._initBubbleChart(),
            this._roundedBarChart && this._roundedBarChart.destroy(),
            this._initRoundedBarChart(),
            this._horizontalRoundedBarChart && this._horizontalRoundedBarChart.destroy(),
            this._initHorizontalRoundedBarChart(),
            this._streamingLineChart && this._streamingLineChart.destroy(),
            this._initStreamingLineChart(),
            this._streamingBarChart && this._streamingBarChart.destroy(),
            this._initStreamingBarChart(),
            this._customTooltipDoughnut && this._customTooltipDoughnut.destroy(),
            this._initCustomTooltipDoughnut(),
            this._customTooltipBar && this._customTooltipBar.destroy(),
            this._initCustomTooltipBar(),
            this._customLegendBar && this._customLegendBar.destroy(),
            this._initCustomLegendBar(),
            this._customLegendDoughnut && this._customLegendDoughnut.destroy(),
            this._initCustomLegendDoughnut(),
            this._smallDoughnutChart1 && this._smallDoughnutChart1.destroy(),
            this._smallDoughnutChart2 && this._smallDoughnutChart2.destroy(),
            this._smallDoughnutChart3 && this._smallDoughnutChart3.destroy(),
            this._smallDoughnutChart4 && this._smallDoughnutChart4.destroy(),
            this._smallDoughnutChart5 && this._smallDoughnutChart5.destroy(),
            this._smallDoughnutChart6 && this._smallDoughnutChart6.destroy(),
            this._initSmallDoughnutCharts(),
            this._smallLineChart1 && this._smallLineChart1.destroy(),
            this._smallLineChart2 && this._smallLineChart2.destroy(),
            this._smallLineChart3 && this._smallLineChart3.destroy(),
            this._smallLineChart4 && this._smallLineChart4.destroy(),
            this._initSmallLineCharts()
        }
        ))
    }
    _initLineChart() {
        if (document.getElementById("lineChart")) {
            const t = document.getElementById("lineChart").getContext("2d");
            this._lineChart = new Chart(t,{
                type: "line",
                options: {
                    plugins: {
                        crosshair: ChartsExtend.Crosshair(),
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 5,
                                min: 50,
                                max: 70,
                                padding: 20,
                                fontColor: Globals.alternate
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: !1
                            },
                            ticks: {
                                fontColor: Globals.alternate
                            }
                        }]
                    },
                    legend: {
                        display: !1
                    },
                    tooltips: ChartsExtend.ChartTooltipForCrosshair()
                },
                data: {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    datasets: [{
                        label: "",
                        data: [60, 54, 68, 60, 63, 60, 65],
                        borderColor: Globals.primary,
                        pointBackgroundColor: Globals.primary,
                        pointBorderColor: Globals.primary,
                        pointHoverBackgroundColor: Globals.primary,
                        pointHoverBorderColor: Globals.primary,
                        borderWidth: 2,
                        pointRadius: 3,
                        pointBorderWidth: 3,
                        pointHoverRadius: 4,
                        fill: !1
                    }]
                }
            })
        }
    }
    _initAreaChart() {
        if (document.getElementById("areaChart")) {
            const t = document.getElementById("areaChart").getContext("2d");
            this._areaChart = new Chart(t,{
                type: "line",
                options: {
                    plugins: {
                        crosshair: ChartsExtend.Crosshair(),
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 5,
                                min: 50,
                                max: 70,
                                padding: 20,
                                fontColor: Globals.alternate
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: !1
                            },
                            ticks: {
                                fontColor: Globals.alternate
                            }
                        }]
                    },
                    legend: {
                        display: !1
                    },
                    tooltips: ChartsExtend.ChartTooltipForCrosshair()
                },
                data: {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    datasets: [{
                        label: "",
                        data: [60, 54, 68, 60, 63, 60, 65],
                        borderColor: Globals.primary,
                        pointBackgroundColor: Globals.foreground,
                        pointBorderColor: Globals.primary,
                        pointHoverBackgroundColor: Globals.primary,
                        pointHoverBorderColor: Globals.foreground,
                        pointRadius: 4,
                        pointBorderWidth: 2,
                        pointHoverRadius: 5,
                        fill: !0,
                        borderWidth: 2,
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)"
                    }]
                }
            })
        }
    }
    _initScatterChart() {
        if (document.getElementById("scatterChart")) {
            const t = document.getElementById("scatterChart").getContext("2d");
            this._scatterChart = new Chart(t,{
                type: "scatter",
                options: {
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 20,
                                min: -80,
                                max: 80,
                                padding: 20,
                                fontColor: Globals.alternate
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight
                            },
                            ticks: {
                                fontColor: Globals.alternate
                            }
                        }]
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                },
                data: {
                    datasets: [{
                        borderWidth: 2,
                        label: "Breads",
                        borderColor: Globals.primary,
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                        data: [{
                            x: 62,
                            y: -78
                        }, {
                            x: -0,
                            y: 74
                        }, {
                            x: -67,
                            y: 45
                        }, {
                            x: -26,
                            y: -43
                        }, {
                            x: -15,
                            y: -30
                        }, {
                            x: 65,
                            y: -68
                        }, {
                            x: -28,
                            y: -61
                        }]
                    }, {
                        borderWidth: 2,
                        label: "Patty",
                        borderColor: Globals.tertiary,
                        backgroundColor: "rgba(" + Globals.tertiaryrgb + ",0.1)",
                        data: [{
                            x: 79,
                            y: 62
                        }, {
                            x: 62,
                            y: 0
                        }, {
                            x: -76,
                            y: -81
                        }, {
                            x: -51,
                            y: 41
                        }, {
                            x: -9,
                            y: 9
                        }, {
                            x: 72,
                            y: -37
                        }, {
                            x: 62,
                            y: -26
                        }]
                    }]
                }
            })
        }
    }
    _initRadarChart() {
        if (document.getElementById("radarChart")) {
            const t = document.getElementById("radarChart").getContext("2d");
            this._radarChart = new Chart(t,{
                type: "radar",
                options: {
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scale: {
                        ticks: {
                            display: !1
                        }
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                },
                data: {
                    datasets: [{
                        label: "Stock",
                        borderWidth: 2,
                        pointBackgroundColor: Globals.primary,
                        borderColor: Globals.primary,
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                        data: [80, 90, 70]
                    }, {
                        label: "Order",
                        borderWidth: 2,
                        pointBackgroundColor: Globals.secondary,
                        borderColor: Globals.secondary,
                        backgroundColor: "rgba(" + Globals.secondaryrgb + ",0.1)",
                        data: [68, 80, 95]
                    }],
                    labels: ["Breads", "Patty", "Pastry"]
                }
            })
        }
    }
    _initPolarChart() {
        if (document.getElementById("polarChart")) {
            const t = document.getElementById("polarChart").getContext("2d");
            this._polarChart = new Chart(t,{
                type: "polarArea",
                options: {
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scale: {
                        ticks: {
                            display: !1
                        }
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                },
                data: {
                    datasets: [{
                        label: "Stock",
                        borderWidth: 2,
                        pointBackgroundColor: Globals.primary,
                        borderColor: [Globals.primary, Globals.secondary, Globals.tertiary],
                        backgroundColor: ["rgba(" + Globals.primaryrgb + ",0.1)", "rgba(" + Globals.secondaryrgb + ",0.1)", "rgba(" + Globals.tertiaryrgb + ",0.1)"],
                        data: [80, 90, 70]
                    }],
                    labels: ["Breads", "Patty", "Pastry"]
                }
            })
        }
    }
    _initPieChart() {
        if (document.getElementById("pieChart")) {
            const t = document.getElementById("pieChart");
            this._pieChart = new Chart(t,{
                type: "pie",
                data: {
                    labels: ["Breads", "Pastry", "Patty"],
                    datasets: [{
                        label: "",
                        borderColor: [Globals.primary, Globals.secondary, Globals.tertiary],
                        backgroundColor: ["rgba(" + Globals.primaryrgb + ",0.1)", "rgba(" + Globals.secondaryrgb + ",0.1)", "rgba(" + Globals.tertiaryrgb + ",0.1)"],
                        borderWidth: 2,
                        data: [15, 25, 20]
                    }]
                },
                draw: function() {},
                options: {
                    plugins: {
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    title: {
                        display: !1
                    },
                    layout: {
                        padding: {
                            bottom: 20
                        }
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                }
            })
        }
    }
    _initDoughnutChart() {
        if (document.getElementById("doughnutChart")) {
            const t = document.getElementById("doughnutChart");
            this._doughnutChart = new Chart(t,{
                plugins: [ChartsExtend.CenterTextPlugin()],
                type: "doughnut",
                data: {
                    labels: ["Breads", "Pastry", "Patty"],
                    datasets: [{
                        label: "",
                        borderColor: [Globals.tertiary, Globals.secondary, Globals.primary],
                        backgroundColor: ["rgba(" + Globals.tertiaryrgb + ",0.1)", "rgba(" + Globals.secondaryrgb + ",0.1)", "rgba(" + Globals.primaryrgb + ",0.1)"],
                        borderWidth: 2,
                        data: [15, 25, 20]
                    }]
                },
                draw: function() {},
                options: {
                    plugins: {
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    cutoutPercentage: 80,
                    title: {
                        display: !1
                    },
                    layout: {
                        padding: {
                            bottom: 20
                        }
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                }
            })
        }
    }
    _initBarChart() {
        if (document.getElementById("barChart")) {
            const t = document.getElementById("barChart").getContext("2d");
            this._barChart = new Chart(t,{
                type: "bar",
                options: {
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 100,
                                min: 300,
                                max: 800,
                                padding: 20,
                                fontColor: Globals.alternate
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: !1
                            }
                        }]
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                },
                data: {
                    labels: ["January", "February", "March", "April"],
                    datasets: [{
                        label: "Breads",
                        borderColor: Globals.primary,
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                        data: [456, 479, 424, 569],
                        borderWidth: 2
                    }, {
                        label: "Patty",
                        borderColor: Globals.secondary,
                        backgroundColor: "rgba(" + Globals.secondaryrgb + ",0.1)",
                        data: [364, 504, 605, 400],
                        borderWidth: 2
                    }]
                }
            })
        }
    }
    _initHorizontalBarChart() {
        if (document.getElementById("horizontalBarChart")) {
            const t = document.getElementById("horizontalBarChart").getContext("2d");
            this._horizontalBarChart = new Chart(t,{
                type: "horizontalBar",
                options: {
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 100,
                                min: 300,
                                max: 800,
                                padding: 20
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: !1
                            }
                        }]
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                },
                data: {
                    labels: ["January", "February", "March", "April"],
                    datasets: [{
                        label: "Breads",
                        borderColor: Globals.primary,
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                        data: [456, 479, 324, 569],
                        borderWidth: 2
                    }]
                }
            })
        }
    }
    _initBubbleChart() {
        document.getElementById("bubbleChart") && (this._bubbleChart = new Chart(document.getElementById("bubbleChart"),{
            type: "bubble",
            data: {
                labels: "",
                datasets: [{
                    borderWidth: 2,
                    label: ["Patty"],
                    backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                    borderColor: Globals.primary,
                    data: [{
                        x: 240,
                        y: 15,
                        r: 15
                    }]
                }, {
                    borderWidth: 2,
                    label: ["Bread"],
                    backgroundColor: "rgba(" + Globals.quaternaryrgb + ",0.1)",
                    borderColor: Globals.quaternary,
                    data: [{
                        x: 140,
                        y: 8,
                        r: 10
                    }]
                }, {
                    borderWidth: 2,
                    label: ["Pastry"],
                    backgroundColor: "rgba(" + Globals.tertiaryrgb + ",0.1)",
                    borderColor: Globals.tertiary,
                    data: [{
                        x: 190,
                        y: 68,
                        r: 20
                    }]
                }]
            },
            options: {
                plugins: {
                    crosshair: !1,
                    datalabels: {
                        display: !1
                    }
                },
                title: {
                    display: !0,
                    text: "Consumption"
                },
                responsive: !0,
                maintainAspectRatio: !1,
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: !0,
                            labelString: "Fat"
                        },
                        ticks: {
                            beginAtZero: !0,
                            stepSize: 20,
                            min: 0,
                            max: 100,
                            padding: 20
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: !0,
                            labelString: "Calories"
                        },
                        ticks: {
                            stepSize: 20,
                            min: 100,
                            max: 300,
                            padding: 20
                        }
                    }]
                },
                tooltips: ChartsExtend.ChartTooltip(),
                legend: {
                    position: "bottom",
                    labels: ChartsExtend.LegendLabels()
                }
            }
        }))
    }
    _initRoundedBarChart() {
        if (document.getElementById("roundedBarChart")) {
            const t = document.getElementById("roundedBarChart").getContext("2d");
            this._roundedBarChart = new Chart(t,{
                type: "bar",
                options: {
                    cornerRadius: parseInt(Globals.borderRadiusMd),
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 100,
                                min: 300,
                                max: 800,
                                padding: 20
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: !1
                            }
                        }]
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                },
                data: {
                    labels: ["January", "February", "March", "April"],
                    datasets: [{
                        label: "Breads",
                        borderColor: Globals.primary,
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                        data: [456, 479, 424, 569],
                        borderWidth: 2
                    }, {
                        label: "Patty",
                        borderColor: Globals.secondary,
                        backgroundColor: "rgba(" + Globals.secondaryrgb + ",0.1)",
                        data: [364, 504, 605, 400],
                        borderWidth: 2
                    }]
                }
            })
        }
    }
    _initHorizontalRoundedBarChart() {
        if (document.getElementById("horizontalRoundedBarChart")) {
            const t = document.getElementById("horizontalRoundedBarChart").getContext("2d");
            this._horizontalRoundedBarChart = new Chart(t,{
                type: "horizontalBar",
                options: {
                    cornerRadius: parseInt(Globals.borderRadiusMd),
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 100,
                                min: 300,
                                max: 800,
                                padding: 20
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: !1
                            }
                        }]
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                },
                data: {
                    labels: ["January", "February", "March", "April"],
                    datasets: [{
                        label: "Breads",
                        borderColor: Globals.primary,
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                        data: [456, 479, 324, 569],
                        borderWidth: 2
                    }]
                }
            })
        }
    }
    _initStreamingLineChart() {
        if (document.getElementById("streamingLineChart")) {
            const t = document.getElementById("streamingLineChart").getContext("2d");
            this._streamingLineChart = new Chart(t,{
                type: "line",
                options: {
                    plugins: {
                        crosshair: ChartsExtend.Crosshair(),
                        datalabels: {
                            display: !1
                        },
                        streaming: {
                            frameRate: 30
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                padding: 20,
                                fontColor: Globals.alternate,
                                min: 0,
                                max: 100,
                                stepSize: 25
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: !1
                            },
                            ticks: {
                                display: !1
                            },
                            type: "realtime",
                            realtime: {
                                duration: 2e4,
                                refresh: 1e3,
                                delay: 3e3,
                                onRefresh: this._onRefresh
                            }
                        }]
                    },
                    legend: {
                        display: !1
                    },
                    tooltips: ChartsExtend.ChartTooltipForCrosshair()
                },
                data: {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    datasets: [{
                        label: "",
                        borderColor: Globals.primary,
                        pointBackgroundColor: Globals.primary,
                        pointBorderColor: Globals.primary,
                        pointHoverBackgroundColor: Globals.primary,
                        pointHoverBorderColor: Globals.primary,
                        borderWidth: 2,
                        pointRadius: 2,
                        pointBorderWidth: 2,
                        pointHoverRadius: 3,
                        fill: !1
                    }]
                }
            })
        }
    }
    _initStreamingBarChart() {
        if (document.getElementById("streamingBarChart")) {
            const t = document.getElementById("streamingBarChart").getContext("2d");
            this._streamingBarChart = new Chart(t,{
                type: "bar",
                data: {
                    labels: [],
                    datasets: [{
                        label: "Breads",
                        data: [],
                        borderColor: Globals.primary,
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                        borderWidth: 2
                    }]
                },
                options: {
                    cornerRadius: parseInt(Globals.borderRadiusMd),
                    plugins: {
                        crosshair: ChartsExtend.Crosshair(),
                        datalabels: {
                            display: !1
                        },
                        streaming: {
                            frameRate: 30
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    title: {
                        display: !1
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                display: !1
                            },
                            type: "realtime",
                            realtime: {
                                duration: 2e4,
                                refresh: 1e3,
                                delay: 3e3,
                                onRefresh: this._onRefresh
                            },
                            gridLines: {
                                display: !1
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 25,
                                min: 0,
                                max: 100,
                                padding: 20
                            }
                        }]
                    },
                    tooltips: ChartsExtend.ChartTooltip(),
                    legend: {
                        display: !1
                    }
                }
            })
        }
    }
    _onRefresh(t) {
        t.config.data.datasets.forEach((function(t) {
            t.data.push({
                x: moment(),
                y: Math.round(50 * Math.random()) + 25
            })
        }
        ))
    }
    _initCustomTooltipDoughnut() {
        if (document.getElementById("verticalTooltipChart")) {
            var t = document.getElementById("verticalTooltipChart").getContext("2d");
            this._customTooltipDoughnut = new Chart(t,{
                type: "doughnut",
                data: {
                    datasets: [{
                        label: "",
                        data: [450, 475, 625],
                        backgroundColor: ["rgba(" + Globals.primaryrgb + ",0.1)", "rgba(" + Globals.secondaryrgb + ",0.1)", "rgba(" + Globals.quaternaryrgb + ",0.1)"],
                        borderColor: [Globals.primary, Globals.secondary, Globals.quaternary]
                    }],
                    labels: ["Burger", "Cakes", "Pastry"],
                    icons: ["burger", "cupcake", "loaf"]
                },
                options: {
                    plugins: {
                        datalabels: {
                            display: !1
                        }
                    },
                    cutoutPercentage: 70,
                    responsive: !0,
                    maintainAspectRatio: !1,
                    title: {
                        display: !1
                    },
                    layout: {
                        padding: {
                            bottom: 20
                        }
                    },
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    tooltips: {
                        enabled: !1,
                        custom: function(t) {
                            var a = this._chart.canvas.parentElement.querySelector(".custom-tooltip");
                            if (0 !== t.opacity) {
                                if (a.classList.remove("above", "below", "no-transform"),
                                t.yAlign ? a.classList.add(t.yAlign) : a.classList.add("no-transform"),
                                t.body) {
                                    var r = this
                                      , e = t.dataPoints[0].index
                                      , o = a.querySelector(".icon");
                                    o.style = "color: " + t.labelColors[0].borderColor,
                                    o.setAttribute("data-acorn-icon", r._data.icons[e]),
                                    (new AcornIcons).replace(),
                                    a.querySelector(".icon-container").style = "border-color: " + t.labelColors[0].borderColor + "!important",
                                    a.querySelector(".text").innerHTML = r._data.labels[e].toLocaleUpperCase(),
                                    a.querySelector(".value").innerHTML = r._data.datasets[0].data[e]
                                }
                                var l = this._chart.canvas.offsetTop
                                  , s = this._chart.canvas.offsetLeft;
                                a.style.opacity = 1,
                                a.style.left = s + t.caretX + "px",
                                a.style.top = l + t.caretY + "px"
                            } else
                                a.style.opacity = 0
                        }
                    }
                }
            })
        }
    }
    _initCustomTooltipBar() {
        if (document.getElementById("horizontalTooltipChart")) {
            var t = document.getElementById("horizontalTooltipChart").getContext("2d");
            this._customTooltipBar = new Chart(t,{
                type: "bar",
                data: {
                    labels: ["January", "February", "March", "April"],
                    datasets: [{
                        label: "Burger",
                        icon: "burger",
                        borderColor: Globals.primary,
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                        data: [456, 479, 424, 569],
                        borderWidth: 2
                    }, {
                        label: "Patty",
                        icon: "loaf",
                        borderColor: Globals.secondary,
                        backgroundColor: "rgba(" + Globals.secondaryrgb + ",0.1)",
                        data: [364, 504, 605, 400],
                        borderWidth: 2
                    }]
                },
                options: {
                    cornerRadius: parseInt(Globals.borderRadiusMd),
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    legend: {
                        position: "bottom",
                        labels: ChartsExtend.LegendLabels()
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 100,
                                min: 300,
                                max: 800,
                                padding: 20
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: !1
                            }
                        }]
                    },
                    tooltips: {
                        enabled: !1,
                        custom: function(t) {
                            var a = this._chart.canvas.parentElement.querySelector(".custom-tooltip");
                            if (0 !== t.opacity) {
                                if (a.classList.remove("above", "below", "no-transform"),
                                t.yAlign ? a.classList.add(t.yAlign) : a.classList.add("no-transform"),
                                t.body) {
                                    var r = this
                                      , e = t.dataPoints[0].index
                                      , o = t.dataPoints[0].datasetIndex
                                      , l = a.querySelector(".icon");
                                    a.querySelector(".icon-container").style = "border-color: " + t.labelColors[0].borderColor + "!important",
                                    l.style = "color: " + t.labelColors[0].borderColor + ";",
                                    l.setAttribute("data-acorn-icon", r._data.datasets[o].icon),
                                    (new AcornIcons).replace(),
                                    a.querySelector(".text").innerHTML = r._data.datasets[o].label.toLocaleUpperCase(),
                                    a.querySelector(".value").innerHTML = r._data.datasets[o].data[e]
                                }
                                var s = this._chart.canvas.offsetTop
                                  , i = this._chart.canvas.offsetLeft;
                                a.style.opacity = 1,
                                a.style.left = i + t.dataPoints[0].x - 75 + "px",
                                a.style.top = s + t.caretY + "px"
                            } else
                                a.style.opacity = 0
                        }
                    }
                }
            })
        }
    }
    _initCustomLegendBar() {
        if (document.getElementById("customLegendBarChart")) {
            const t = document.getElementById("customLegendBarChart").getContext("2d");
            this._customLegendBar = new Chart(t,{
                type: "bar",
                options: {
                    cornerRadius: parseInt(Globals.borderRadiusMd),
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    scales: {
                        yAxes: [{
                            stacked: !0,
                            gridLines: {
                                display: !0,
                                lineWidth: 1,
                                color: Globals.separatorLight,
                                drawBorder: !1
                            },
                            ticks: {
                                beginAtZero: !0,
                                stepSize: 200,
                                min: 0,
                                max: 800,
                                padding: 20
                            }
                        }],
                        xAxes: [{
                            stacked: !0,
                            gridLines: {
                                display: !1
                            },
                            barPercentage: .5
                        }]
                    },
                    legend: !1,
                    legendCallback: function(t) {
                        const a = t.canvas.parentElement.parentElement.querySelector(".custom-legend-container");
                        a.innerHTML = "";
                        const r = t.canvas.parentElement.parentElement.querySelector(".custom-legend-item");
                        for (let l = 0; l < t.data.datasets.length; l++) {
                            var e = r.content.cloneNode(!0)
                              , o = t.data.datasets[l].data.reduce((function(t, a) {
                                return t + a
                            }
                            ));
                            e.querySelector(".text").innerHTML = t.data.datasets[l].label.toLocaleUpperCase(),
                            e.querySelector(".value").innerHTML = o,
                            e.querySelector(".value").style = "color: " + t.data.datasets[l].borderColor + "!important",
                            e.querySelector(".icon-container").style = "border-color: " + t.data.datasets[l].borderColor + "!important",
                            e.querySelector(".icon").style = "color: " + t.data.datasets[l].borderColor + "!important",
                            e.querySelector(".icon").setAttribute("data-acorn-icon", t.data.icons[l]),
                            e.querySelector("a").addEventListener("click", (a=>{
                                a.preventDefault();
                                const r = t.getDatasetMeta(l).hidden;
                                t.getDatasetMeta(l).hidden = !r,
                                a.currentTarget.classList.contains("opacity-50") ? a.currentTarget.classList.remove("opacity-50") : a.currentTarget.classList.add("opacity-50"),
                                t.update()
                            }
                            )),
                            a.appendChild(e)
                        }
                        (new AcornIcons).replace()
                    },
                    tooltips: {
                        enabled: !1,
                        custom: function(t) {
                            var a = this._chart.canvas.parentElement.querySelector(".custom-tooltip");
                            if (0 !== t.opacity) {
                                if (a.classList.remove("above", "below", "no-transform"),
                                t.yAlign ? a.classList.add(t.yAlign) : a.classList.add("no-transform"),
                                t.body) {
                                    var r = this
                                      , e = t.dataPoints[0].index
                                      , o = t.dataPoints[0].datasetIndex
                                      , l = a.querySelector(".icon");
                                    a.querySelector(".icon-container").style = "border-color: " + t.labelColors[0].borderColor + "!important",
                                    l.style = "color: " + t.labelColors[0].borderColor + ";",
                                    l.setAttribute("data-acorn-icon", r._data.icons[o]),
                                    (new AcornIcons).replace(),
                                    a.querySelector(".text").innerHTML = r._data.datasets[o].label.toLocaleUpperCase(),
                                    a.querySelector(".value").innerHTML = r._data.datasets[o].data[e],
                                    a.querySelector(".value").style = "color: " + t.labelColors[0].borderColor + ";"
                                }
                                var s = this._chart.canvas.offsetTop
                                  , i = this._chart.canvas.offsetLeft;
                                a.style.opacity = 1,
                                a.style.left = i + t.dataPoints[0].x - 75 + "px",
                                a.style.top = s + t.caretY + "px"
                            } else
                                a.style.opacity = 0
                        }
                    }
                },
                data: {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    datasets: [{
                        label: "Breads",
                        backgroundColor: "rgba(" + Globals.primaryrgb + ",0.1)",
                        borderColor: Globals.primary,
                        borderWidth: 2,
                        data: [213, 434, 315, 367, 289, 354, 242]
                    }, {
                        label: "Cakes",
                        backgroundColor: "rgba(" + Globals.secondaryrgb + ",0.1)",
                        borderColor: Globals.secondary,
                        borderWidth: 2,
                        data: [143, 234, 156, 207, 191, 214, 95]
                    }],
                    icons: ["loaf", "cupcake"]
                }
            }),
            this._customLegendBar.generateLegend()
        }
    }
    _initCustomLegendDoughnut() {
        if (document.getElementById("customLegendDoughnutChart")) {
            const t = document.getElementById("customLegendDoughnutChart").getContext("2d");
            this._customLegendDoughnut = new Chart(t,{
                type: "doughnut",
                options: {
                    cutoutPercentage: 70,
                    plugins: {
                        crosshair: !1,
                        datalabels: {
                            display: !1
                        }
                    },
                    responsive: !0,
                    maintainAspectRatio: !1,
                    title: {
                        display: !1
                    },
                    layout: {
                        padding: {
                            bottom: 20
                        }
                    },
                    legend: !1,
                    legendCallback: function(t) {
                        const a = t.canvas.parentElement.parentElement.querySelector(".custom-legend-container");
                        a.innerHTML = "";
                        const r = t.canvas.parentElement.parentElement.querySelector(".custom-legend-item");
                        for (let o = 0; o < t.data.datasets[0].data.length; o++) {
                            var e = r.content.cloneNode(!0);
                            e.querySelector(".text").innerHTML = t.data.labels[o].toLocaleUpperCase(),
                            e.querySelector(".value").innerHTML = t.data.datasets[0].data[o],
                            e.querySelector(".value").style = "color: " + t.data.datasets[0].borderColor[o] + "!important",
                            e.querySelector(".icon-container").style = "border-color: " + t.data.datasets[0].borderColor[o] + "!important",
                            e.querySelector(".icon").style = "color: " + t.data.datasets[0].borderColor[o] + "!important",
                            e.querySelector(".icon").setAttribute("data-acorn-icon", t.data.icons[o]),
                            e.querySelector("a").addEventListener("click", (a=>{
                                a.preventDefault();
                                const r = t.getDatasetMeta(0).data[o].hidden;
                                t.getDatasetMeta(0).data[o].hidden = !r,
                                a.currentTarget.classList.contains("opacity-50") ? a.currentTarget.classList.remove("opacity-50") : a.currentTarget.classList.add("opacity-50"),
                                t.update()
                            }
                            )),
                            a.appendChild(e)
                        }
                        (new AcornIcons).replace()
                    },
                    tooltips: ChartsExtend.ChartTooltip()
                },
                data: {
                    datasets: [{
                        label: "",
                        data: [450, 475, 625],
                        backgroundColor: ["rgba(" + Globals.primaryrgb + ",0.1)", "rgba(" + Globals.secondaryrgb + ",0.1)", "rgba(" + Globals.quaternaryrgb + ",0.1)"],
                        borderColor: [Globals.primary, Globals.secondary, Globals.quaternary]
                    }],
                    labels: ["Burger", "Cakes", "Pastry"],
                    icons: ["burger", "cupcake", "loaf"]
                }
            }),
            this._customLegendDoughnut.generateLegend()
        }
    }
    _initSmallDoughnutCharts() {
        document.getElementById("smallDoughnutChart1") && (this._smallDoughnutChart1 = ChartsExtend.SmallDoughnutChart("smallDoughnutChart1", [14, 0], "PURCHASING")),
        document.getElementById("smallDoughnutChart2") && (this._smallDoughnutChart2 = ChartsExtend.SmallDoughnutChart("smallDoughnutChart2", [12, 6], "PRODUCTION")),
        document.getElementById("smallDoughnutChart3") && (this._smallDoughnutChart3 = ChartsExtend.SmallDoughnutChart("smallDoughnutChart3", [22, 8], "PACKAGING")),
        document.getElementById("smallDoughnutChart4") && (this._smallDoughnutChart4 = ChartsExtend.SmallDoughnutChart("smallDoughnutChart4", [1, 5], "DELIVERY")),
        document.getElementById("smallDoughnutChart5") && (this._smallDoughnutChart5 = ChartsExtend.SmallDoughnutChart("smallDoughnutChart5", [4, 6], "EDUCATION")),
        document.getElementById("smallDoughnutChart6") && (this._smallDoughnutChart6 = ChartsExtend.SmallDoughnutChart("smallDoughnutChart6", [3, 8], "PAYMENTS"))
    }
    _initSmallLineCharts() {
        this._smallLineChart1 = ChartsExtend.SmallLineChart("smallLineChart1", {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            datasets: [{
                label: "BTC / USD",
                data: [9415.1, 9430.3, 9436.8, 9471.5, 9467.2],
                icons: ["chevron-bottom", "chevron-top", "chevron-top", "chevron-top", "chevron-bottom"],
                borderColor: Globals.primary,
                pointBackgroundColor: Globals.primary,
                pointBorderColor: Globals.primary,
                pointHoverBackgroundColor: Globals.foreground,
                pointHoverBorderColor: Globals.primary,
                borderWidth: 2,
                pointRadius: 2,
                pointBorderWidth: 2,
                pointHoverBorderWidth: 2,
                pointHoverRadius: 5,
                fill: !1
            }]
        }),
        this._smallLineChart2 = ChartsExtend.SmallLineChart("smallLineChart2", {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            datasets: [{
                label: "ETH / USD",
                data: [325.3, 310.4, 338.2, 347.1, 348],
                icons: ["chevron-top", "chevron-bottom", "chevron-top", "chevron-top", "chevron-top"],
                borderColor: Globals.primary,
                pointBackgroundColor: Globals.primary,
                pointBorderColor: Globals.primary,
                pointHoverBackgroundColor: Globals.foreground,
                pointHoverBorderColor: Globals.primary,
                borderWidth: 2,
                pointRadius: 2,
                pointBorderWidth: 2,
                pointHoverBorderWidth: 2,
                pointHoverRadius: 5,
                fill: !1
            }]
        }),
        this._smallLineChart3 = ChartsExtend.SmallLineChart("smallLineChart3", {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            datasets: [{
                label: "LTC / USD",
                data: [43.3, 42.8, 45.3, 45.3, 41.4],
                icons: ["chevron-top", "chevron-bottom", "chevron-top", "circle", "chevron-top"],
                borderColor: Globals.primary,
                pointBackgroundColor: Globals.primary,
                pointBorderColor: Globals.primary,
                pointHoverBackgroundColor: Globals.foreground,
                pointHoverBorderColor: Globals.primary,
                borderWidth: 2,
                pointRadius: 2,
                pointBorderWidth: 2,
                pointHoverBorderWidth: 2,
                pointHoverRadius: 5,
                fill: !1
            }]
        }),
        this._smallLineChart4 = ChartsExtend.SmallLineChart("smallLineChart4", {
            labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            datasets: [{
                label: "XRP / USD",
                data: [.25, .253, .268, .243, .243],
                icons: ["chevron-top", "chevron-top", "chevron-top", "chevron-bottom", "circle"],
                borderColor: Globals.primary,
                pointBackgroundColor: Globals.primary,
                pointBorderColor: Globals.primary,
                pointHoverBackgroundColor: Globals.foreground,
                pointHoverBorderColor: Globals.primary,
                borderWidth: 2,
                pointRadius: 2,
                pointBorderWidth: 2,
                pointHoverBorderWidth: 2,
                pointHoverRadius: 5,
                fill: !1
            }]
        })
    }
}
