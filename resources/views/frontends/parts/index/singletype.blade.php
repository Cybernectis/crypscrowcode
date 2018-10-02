 <div class=" mt-2 mb-4">
    <h4 class='vedio-head'>{{$type}} top coins these top around the world:</h4>
    <br>
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 table-responsive pd-0">
        <table class="table" style="font-size: 14px">
            @forelse($singletrades as $strades)
            <tr class="table-row">
                <td><b><i class="fa fa-paper-plane"></i></b></td>
                @php 
                $username = $strades->userData()->value('username')
                @endphp
                <td><a href='{{url("profile/$username")}}'><b>{{$username}}</b></a>
                
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
                            {{$type}} {{$strades->getlocalcoin->short_name}}@
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
        <a href='{{url("offers/$type")}}'>
            <button class="btn create-btn mb-4">Browse  {{$btnType}}</button>
        </a>
    </div>
</div>