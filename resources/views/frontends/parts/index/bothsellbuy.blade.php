 <div class=" mt-2 ">
    <h4 class='vedio-head'>Buy top currency from these top sellers around the world:</h4>
    <br>
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 table-responsive pd-0">
        <table class="table" style="font-size: 14px">
            @forelse($buyTrades as $btrades)
            <tr class="table-row">
                <td><b><i class="fa fa-paper-plane"></i></b></td>
                @php 
                $username = $btrades->userData()->value('username')
                @endphp
                <td class="text-center"><a href='{{url("profile/$username")}}'><b>{{$username}}</b></a>
                    <br><!-- <span>585+ trades</span> --></td>
                <td><b>{{$btrades->userPaymentMethod()->value('name')}}</b> 
                    <br><span>{{$btrades->headline}}</span></td>
                <td><b>{{$btrades->city}}</b>
                    <br><!-- <span>Country</span> --></td>
                <td class="text-right">{{Helper::getDisplayTradeLimit($btrades->id)}}&emsp;&emsp;
                      @php 
                    $param = base64_encode($btrades->id);
                    @endphp
                    <a href='{{url("offer/$param")}}'>
                        <button class="btn create-btn">Buy {{$btrades->getlocalcoin->short_name}}@
                            <br><strong>{{$btrades->userLocalCurrency()->value('short_name')}} {{$btrades->crypscrow_price}}</strong>
                        </button>
                    </a>
                </td>
            </tr>
            @empty
            <tr class="table-row">
                <td>
                    No Records
                </td>
            </tr>

            @endforelse
            
        </table>
        <a href='{{url("offers/Buy")}}'>
            <button class="btn create-btn mb-4">Browse sellers</button>
        </a>
    </div>
</div>
<div class=" mt-2 mb-4">
    <h4 class='vedio-head'>Sell top currency to these top buyers around the world:</h4>
    <br>
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 table-responsive pd-0">
        <table class="table" style="font-size: 14px">
            @forelse($sellTrades as $strades)
            <tr class="table-row">
                <td><b><i class="fa fa-paper-plane"></i></b></td>
                @php 
                $username = $strades->userData()->value('username')
                @endphp
                <td class="text-center"><a href='{{url("profile/$username")}}'><b>{{$username}}</b></a>
                
                    <br><!-- <span>585+ trades</span> --></td>
                <td><b>{{$strades->userPaymentMethod()->value('name')}}</b> 
                    <br><span>{{$strades->headline}}</span></td>
                <td><b>{{$strades->city}}</b>
                    <br><!-- <span>Country</span> --></td>
                <td class="text-right">{{Helper::getDisplayTradeLimit($strades->id)}}&emsp;&emsp;
                    @php 
                    $param = base64_encode($strades->id);
                    @endphp
                    <a href='{{url("offer/$param")}}'>
                        <button class="btn create-btn">
                            SELL {{$strades->getlocalcoin->short_name}}@
                            <br><strong>{{$strades->userLocalCurrency()->value('short_name')}} {{$strades->crypscrow_price}}</strong>
                        </button>
                    </a>
                </td>
            </tr>
            @empty
            <tr class="table-row">
                <td>
                    No Records
                </td>
            </tr>

            @endforelse
        </table>
        <a href='{{url("offers/Sell")}}'>
            <button class="btn create-btn mb-4">Browse  buyers</button>
        </a>
    </div>
</div>