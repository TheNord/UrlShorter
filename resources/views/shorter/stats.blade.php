@extends('layouts.app')

@section('content')

    <div class="container">
        <a href="{{ route('shorter.show', $link) }}" class="btn btn-primary mb-5">Back</a>

        <table class="table">
            @foreach ($dates as $date)
                <tr>
                    <th scope="row">{{ $date->date }}</th>
                    <td>{{ $date->views }}</td>
                </tr>
            @endforeach

        </table>

        <div id="container" style="margin-top: 100px;"></div>

        <script>
            Highcharts.chart('container', {

                title: {
                    text: 'Statistics on the site: {{ $link->url }} '
                },

                yAxis: {
                    title: {
                        text: 'Views'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                xAxis: {
                    categories: [ {!! $datesResult  !!} ]
                },

                series: [{
                    name: 'Views',
                    data: [{{ $viewsResult }}]
                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });
        </script>
    </div>


@endsection

    @section('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/series-label.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
    @endsection