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
                <th>Country</th>
                <th>Unique Visitors</th>
                <th>Visits</th>
                <th>Last Visit</th>
            </thead>

            <tbody>
                @foreach ($visits as $visit)
                    <tr>
                        <td>
                            @if ($visit->country_code)
                                @if (file_exists(public_path('vendor/visitortracker/icons/flags/'.$visit->country_code.'.png')))
                                    <img class="visitortracker-icon"
                                        src="{{ asset('/vendor/visitortracker/icons/flags/'.$visit->country_code.'.png') }}"
                                        title="{{ $visit->country }}"
                                        alt="{{ $visit->country_code }}">
                                @else
                                    <img class="visitortracker-icon"
                                        src="{{ asset('/vendor/visitortracker/icons/flags/unknown.png') }}"
                                        title="Unknown">
                                @endif

                                {{ $visit->country }}
                            @else
                                <img class="visitortracker-icon"
                                    src="{{ asset('/vendor/visitortracker/icons/flags/unknown.png') }}"
                                    title="Unknown">
                                
                                Unknown
                            @endif
                        </td>
                            
                        <td>
                            {{ $visit->visitors_count }}
                        </td>

                        <td>
                            {{ $visit->visits_count }}
                        </td>

                        <td>
                            @include('visitstats::_last_visit')
                        </td>
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
