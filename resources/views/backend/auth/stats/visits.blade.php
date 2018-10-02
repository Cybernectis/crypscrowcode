@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.stats.management'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                   {{$visitortrackerSubtitle}} - {{ __('labels.backend.access.stats.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
             
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <div class="table-responsive">

                       @include('visitstats::_table_requests')

                       
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
