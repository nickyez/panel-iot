@extends('layouts.main')

@section('content')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <div id="container"></div>
@endsection

@push('scripts')
<script>
    let chart; // global
    let url = '{{url('/')}}';
/**
 * Request data from the server, add it to the graph and set a timeout to request again
 */
async function requestData() {
    const result = await fetch(url+'/api/temperature');
    if (result.ok) {
        const data = await result.json();

        const [date, value] = [data.data[0].created_at, data.data[0].temperature];
        const point = [new Date(date).getTime(), parseFloat(value)]; // Bagian ini yang dirubah
        const series = chart.series[0],
            shift = series.data.length > 20; // shift if the series is longer than 20
        // add the point
        chart.series[0].addPoint(point, true, shift);
        // call it again after one second
        setTimeout(requestData, 1000);
    }
}

window.addEventListener('load', function () {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'spline',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Data temperature'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Value',
                margin: 80
            }
        },
        series: [{
            name: 'Celcius',
            data: []
        }]
    });
});
</script>
@endpush