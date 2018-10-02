<tr class="table-row">
    <td><b><i class="fa fa-bolt"></i></b></td>
    @php 
    $username = $btrades->userData()->value('username')
    @endphp
    <td><a href='{{url("profile/$username")}}'><b>{{$username}}</b></a>
        <br><!-- <span>585+ trades</span> --></td>
    <td><b>{{$btrades->userPaymentMethod()->value('name')}}</b> 
        <br><span>{{$btrades->headline}}</span></td>
    <td><b>{{$btrades->city}}</b>
        <br><span>Country</span></td>
    <td class="text-right">{{Helper::getDisplayTradeLimit($btrades->id)}}&emsp;&emsp;
          @php 
        $param = base64_encode($btrades->id);
        @endphp
        <a href='{{url("offer/$param")}}'>
            <button class="btn create-btn">Buy @
                <br><strong>{{$btrades->userLocalCurrency()->value('short_name')}} {{$btrades->price}}</strong>
            </button>
        </a>
    </td>
</tr>