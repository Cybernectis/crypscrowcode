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
                <th>User</th>
                <th>Visits</th>
                <th>Last Visit</th>
            </thead>

            <tbody>
                @foreach ($visits as $visit)
                    <tr>
                        <td>
                            @if ($visit->user_id)
                                <img class="visitortracker-icon"
                                    src="{{ asset('/vendor/visitortracker/icons/user.png') }}"
                                    title="Authenticated user: {{ $visit->user_email }}">
                                
                                {{ $visit->user_email }}
                            @endif
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
