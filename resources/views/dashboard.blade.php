<x-app-layout>
    <div class="ml-60 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="ml-4 p-6 text-gray-700 font-bold">
                    Monthly Return Count and Return Rate
                </div>

                <!-- Include ApexCharts script -->
                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

                <div class="mx-3">
                    <!-- Chart container -->
                    <div id="chart" class="w-full"></div>

                    <!-- Your chart script -->
                    <script>
                        var options = {
                            series: [
                                {
                                    name: 'Return Count',
                                    type: 'line', // Change the type to line
                                    data: [10, 15, 8, 20, 12, 25, 18, 22, 30, 16, 12, 28]
                                },
                                {
                                    name: 'Return Rate',
                                    type: 'line', // Change the type to line
                                    data: [1, 4, 2, 5, 3, 6, 5, 17, 9, 4, 3, 7]
                                }
                            ],
                            chart: {
                                height: 350,
                                type: 'line',
                                stacked: false,
                                toolbar: {
                                    show: false
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth'
                            },
                            xaxis: {
                                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            },
                            yaxis: [
                                {
                                    axisTicks: {
                                        show: true,
                                    },
                                    axisBorder: {
                                        show: true,
                                        color: '#008FFB'
                                    },
                                    labels: {
                                        style: {
                                            color: '#008FFB',
                                        }
                                    },
                                    title: {
                                        text: "Return Count",
                                        style: {
                                            color: '#008FFB',
                                        }
                                    },
                                    tooltip: {
                                        enabled: true
                                    }
                                },
                                {
                                    seriesName: 'Return Rate',
                                    opposite: true,
                                    axisTicks: {
                                        show: true,
                                    },
                                    axisBorder: {
                                        show: true,
                                        color: '#00E396'
                                    },
                                    labels: {
                                        style: {
                                            color: '#00E396',
                                        }
                                    },
                                    title: {
                                        text: "Return Rate",
                                        style: {
                                            color: '#00E396',
                                        }
                                    },
                                },
                            ],
                            tooltip: {
                                shared: true,
                                intersect: false,
                                y: {
                                    formatter: function (y) {
                                        if(typeof y !== "undefined") {
                                            return y.toFixed(0) + " returns";
                                        }
                                        return y;
                                    }
                                }
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#chart"), options);
                        chart.render();
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
