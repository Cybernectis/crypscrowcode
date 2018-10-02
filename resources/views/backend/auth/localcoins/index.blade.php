@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.localcoins.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.localcoins.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.localcoins.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.access.localcoins.table.name') }}</th>
                            <th>{{ __('labels.backend.access.localcoins.table.short_name') }}</th>
                             <th>{{ __('labels.backend.access.localcoins.table.unit_name') }}</th>
                            <th>{{ __('labels.backend.access.localcoins.table.unit_value') }}</th>
                            <th>{{ __('labels.backend.access.localcoins.table.creator_percentage') }}</th>
                            <th>{{ __('labels.backend.access.localcoins.table.taker_percentage') }}</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($localCoins as $localCoin)
                                <tr>
                                    <td>{{ $localCoin->name}}</td>
                                    <td>
                                        {{ $localCoin->short_name }}
                                    </td>
                                     <td>
                                        {{ $localCoin->unit_name }}
                                    </td>
                                    <td>
                                        {{ $localCoin->unit_value }}
                                    </td>
                                    <td>
                                        {{ $localCoin->creator_percentage }}
                                    </td>
                                    <td>
                                        {{ $localCoin->taker_percentage }}
                                    </td>
                                    <td>
                                        {!! $localCoin->action_buttons !!}
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
