<div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.addEventListener('dateUpdated', event => {
                let { sales, lastsales, people } = event.detail[0];
                var chart1 = new CanvasJS.Chart("chart1", {
                    exportEnabled: true,
                    animationEnabled: true,
                    title: {
                        text: "Thống kê theo tháng"
                    },
                    axisY: {
                        title: "Tháng trước",
                        titleFontColor: "#4F81BC",
                        lineColor: "#4F81BC",
                        labelFontColor: "#4F81BC",
                        tickColor: "#4F81BC",
                        includeZero: true
                    },
                    axisY2: {
                        title: "Tháng này",
                        titleFontColor: "#C0504E",
                        lineColor: "#C0504E",
                        labelFontColor: "#C0504E",
                        tickColor: "#C0504E",
                        includeZero: true
                    },
                    toolTip: {
                        shared: true
                    },
                    legend: {
                        cursor: "pointer",
                        itemclick: toggleDataSeries
                    },
                    data: [{
                        type: "column",
                        name: "Tháng trước",
                        showInLegend: true,
                        yValueFormatString: "#,##0.# VND",
                        dataPoints: [
                            { label: "Doanh thu", y: lastsales[0] },
                            { label: "Lợi nhuận", y: lastsales[1] }
                        ]
                    },
                    {
                        type: "column",
                        name: "Tháng này",
                        axisYType: "secondary",
                        showInLegend: true,
                        yValueFormatString: "#,##0.# VND",
                        dataPoints: [
                            { label: "Doanh thu", y: sales[0] },
                            { label: "Lợi nhuận", y: sales[1] }
                        ]
                    }]
                });
                chart1.render();

                var chart2 = new CanvasJS.Chart("chart2", {
                    exportEnabled: true,
                    animationEnabled: true,
                    title: {
                        text: "Thống kê theo tháng"
                    },
                    axisY: {
                        title: "Tháng trước",
                        titleFontColor: "#4F81BC",
                        lineColor: "#4F81BC",
                        labelFontColor: "#4F81BC",
                        tickColor: "#4F81BC",
                        includeZero: true
                    },
                    axisY2: {
                        title: "Tháng này",
                        titleFontColor: "#C0504E",
                        lineColor: "#C0504E",
                        labelFontColor: "#C0504E",
                        tickColor: "#C0504E",
                        includeZero: true
                    },
                    toolTip: {
                        shared: true
                    },
                    legend: {
                        cursor: "pointer",
                        itemclick: toggleDataSeries
                    },
                    data: [{
                        type: "column",
                        name: "Tháng trước",
                        showInLegend: true,
                        yValueFormatString: "#,##0.# Người",
                        dataPoints: [
                            { label: "Số người", y: people[1] }
                        ]
                    },
                    {
                        type: "column",
                        name: "Tháng này",
                        axisYType: "secondary",
                        showInLegend: true,
                        yValueFormatString: "#,##0.# Người",
                        dataPoints: [
                            { label: "Số người", y: people[0] }
                        ]
                    }]
                });
                chart2.render();

                function toggleDataSeries(e) {
                    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                    } else {
                        e.dataSeries.visible = true;
                    }
                    e.chart.render();
                }
            })

        });
    </script>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tổng quan tháng {{$date ?? ''}} </h6>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary" wire:click='resetData'><i class="fa-solid fa-repeat"></i></button>
            <input type="date" class="form-control" wire:model.live='date'>
        </div>
    </div>
    <div class="d-flex gap-2" wire:ignore>
        <div id="chart1" style="height: 370px; width: 100%;"></div>
        <div id="chart2" style="height: 370px; width: 100%;"></div>
    </div>

</div>

