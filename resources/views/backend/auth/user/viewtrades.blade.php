@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.access.users.management'))



@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.users.management') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        
                            <tr>
                                <th>Date opened</th>
                                <th>Type</th>
                                <th>Coin</th>
                                <th>Amount</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($user->trades as $value)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('F d, Y') }}</td>
                                <td><b>{{$value->userOfferTrades()->value('type_name')}}</b></td>
                                <td>{{$value->getlocalcoin()->value('short_name')}}</td>
                                <td>{{$value->price}} {{$value->userLocalCurrency()->value('short_name')}}</td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
