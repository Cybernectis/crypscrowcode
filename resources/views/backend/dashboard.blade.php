@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>
                </div><!--card-header-->
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <div class="h1 text-muted text-right mb-4">
                                        <i class="icon-people"></i>
                                    </div>
                                    <div class="h4 mb-0">{{$usercount}}</div>
                                    <small class="text-muted text-uppercase font-weight-bold">Users</small>
                                    <div class="progress progress-white progress-xs mt-3">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <div class="h1 text-muted text-right mb-4">
                                        <i class="icon-user-follow"></i>
                                    </div>
                                    <div class="h4 mb-0">{{$tradescount}}</div>
                                    <small class="text-muted text-uppercase font-weight-bold">Total Trades</small>
                                    <div class="progress progress-white progress-xs mt-3">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <div class="h1 text-muted text-right mb-4">
                                        <i class="icon-basket-loaded"></i>
                                    </div>
                                    <div class="h4 mb-0">{{count($localCurrency)}}</div>
                                    <small class="text-muted text-uppercase font-weight-bold">Local Currency Support</small>
                                    <div class="progress progress-white progress-xs mt-3">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <div class="h1 text-muted text-right mb-4">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                    <div class="h4 mb-0">{{count($localCoin)}}</div>
                                    <small class="text-muted text-uppercase font-weight-bold">Local Coins Support</small>
                                    <div class="progress progress-white progress-xs mt-3">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <div id="canvas-holder" >
                                <canvas id="chart-area"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6">
                             <div id="geo-canvas-holder" >
                                <canvas id="geo-chart-area"></canvas>
                            </div>
                        </div>
                        <!-- <div class="col-sm-6 col-md-2">
                            <div class="card text-white bg-danger">
                                <div class="card-body">
                                    <div class="h1 text-muted text-right mb-4">
                                        <i class="icon-speedometer"></i>
                                    </div>
                                    <div class="h4 mb-0">5:34:11</div>
                                    <small class="text-muted text-uppercase font-weight-bold">Avg. Time</small>
                                    <div class="progress progress-white progress-xs mt-3">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <div class="h1 text-muted text-right mb-4">
                                        <i class="icon-speech"></i>
                                    </div>
                                    <div class="h4 mb-0">972</div>
                                    <small class="text-muted text-uppercase font-weight-bold">Comments</small>
                                    <div class="progress progress-white progress-xs mt-3">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    
                </div><!--card-block-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    @push("after-scripts")
        <script>
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        "{{$femaleCount}}",
                        "{{$maleCount}}",
                    ],
                    backgroundColor: [
                       "#FF6384",
                        "#36A2EB"
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Female',
                    'Male'
                ]
            },
            options: {
                responsive: true
            }
        };

       

       
    
        var config1 = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                            @foreach($countryData as $value)
                            
                                {{"$value->visits_count"}},
                            
                            @endforeach
                       
                    ],
                    backgroundColor: [
                       // "#FF6384",
                       //  "#36A2EB"
                        @foreach($countryData as $value)
                        
                            @if(end($countryData) == $value)
                                {!!'"#'.substr(md5(rand()), 0, 6).'"'!!}
                            @else
                                {!!'"#'.substr(md5(rand()), 0, 6).'",'!!}
                            @endif 
                        @endforeach
                    ],
                    label: 'Dataset 2'
                }],
                labels: [
                    @foreach($countryData as $value)
                        @php
                        $counrty = empty($value->country) ? 'unknown':  $value->country;
                        @endphp
                        @if(end($countryData) == $value)
                            {!!'"'.$counrty.'"'!!}
                        @else
                            {!!'"'."$counrty".'",'!!}
                        @endif 
                    @endforeach
                ]
            },
            options: {
                responsive: true
            }
        };
         window.onload = function() {
            var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
            var ctx1 = document.getElementById('geo-chart-area').getContext('2d');
            window.myPie1 = new Chart(ctx1, config1);
        };
      
    </script>
    @endpush
@endsection
