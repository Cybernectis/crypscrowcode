@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.exchange.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.exchange.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.exchange.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.access.exchange.table.api_name') }}</th>
                            <th>{{ __('labels.backend.access.exchange.table.token_code') }}</th>
                            <th>{{ __('labels.backend.access.exchange.table.currency') }}</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($exchangeRates as $exchangeRate)
                                <tr>
                                    <td>{{ $exchangeRate->api_name}}</td>
                                    <td>
                                        {{ $exchangeRate->token_code }}
                                    </td>
                                    <td>
                                        {{ $exchangeRate->currency }}
                                    </td>
                                    <td>
                                        {!! $exchangeRate->action_buttons !!}
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
                    
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
