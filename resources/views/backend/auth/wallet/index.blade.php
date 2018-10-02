@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.wallet.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.wallet.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.wallet.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('labels.backend.access.wallet.table.coin') }}</th>
                            <th>{{ __('labels.backend.access.wallet.table.address') }}</th>
                            <th>{{ __('labels.backend.access.wallet.table.public_key') }}</th>
                            <th>{{ __('labels.backend.access.wallet.table.private_key') }}</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($wallets as $wallet)
                            <tr> 
                                <td>{{ $wallet->dataLocalCoin()->value('name')."(".$wallet->dataLocalCoin()->value('short_name'). ")" }}</td>
                                <td>
                                    {{ $wallet->address }}
                                </td>
                                <td>
                                    {{ $wallet->public_key }}
                                </td>

                                <td> 
                                    <input type="text" name="test_{{$wallet->id}}" value="{{$wallet->private_key}}" id="row_{{$wallet->id}}"  style="display: none" >
                                    <a href="javascript:void(0)" onclick='CopyToClipboard("row_{{$wallet->id}}")' data-toggle="tooltip" title="Copy Private Key"> <i class="fa fa-eye"></i></a>
                                </td> 
                                <td>
                                    {{Helper::getWalletBalance($wallet->address, $wallet->dataLocalCoin()->value('short_name'))}}
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
