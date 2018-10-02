@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.stats.management'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                  {{$visitortrackerSubtitle}} -   {{ __('labels.backend.access.stats.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
             
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped fs-1">
                            <thead>
                                <th>Request</th>
                                <th>Referrer</th>
                                <th>Visitor</th>
                            </thead>

                            <tbody>
                                @foreach ($visits as $visit)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::parse($visit->created_at)
                                                ->tz(config('visitortracker.timezone', 'UTC'))
                                                ->format(config('visitortracker.datetime_format')) }}
                                            
                                            <br>

                                            {{ $visit->is_ajax ? 'AJAX' : '' }}
                                            
                                            @if ($visit->is_login_attempt)
                                                <img class="visitortracker-icon"
                                                    src="{{ asset('/vendor/visitortracker/icons/login_attempt.png') }}"
                                                    title="Login attempt">
                                            @endif

                                            {{ $visit->method }} 
                                            <a href="{{ $visit->url }}" target="_blank">{{ $visit->url }}</a>
                                        </td>

                                        <td>
                                            {!!
                                                $visit->referer
                                                ? '<a href="' . $visit->referer . '" target="_blank">' . $visit->referer . '</a>'
                                                : '-'
                                            !!}
                                        </td>

                                        <td>@include('visitstats::_visitor')</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                   
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $visits->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
