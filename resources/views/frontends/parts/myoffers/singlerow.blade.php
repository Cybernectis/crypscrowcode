<tr id="row_{{$value->id}}">
    <td>{{$value->userOfferTrades()->value('type_name')}}</td>
    <td><strong>{{$value->userPaymentMethod()->value('name')}}</strong></td>
    <td class="text-capitalize">{{$value->city}}</td>
    <td>{{Helper::getDisplayTradeLimit($value->id)}}</td>
    <td> {{$value->price}}</td>
    <td class="text-center">
        @if($value->is_paused)
            <button class="btn pause-btn" type="button" name="resume_{{$value->id}}" id="resume_{{$value->id}}" onclick="updateTradeStatus({{$value->id}}, 0)">RESUME </button>
        @else
            <button class="btn pause-btn" type="button" name="pause_{{$value->id}}" id="pause_{{$value->id}}" onclick="updateTradeStatus({{$value->id}}, 1)"><i class="fa fa-pause"></i>&emsp;PAUSE </button>
        @endif
        @php
        
        $parameter= base64_encode($value->id);
        @endphp
        <a class="btn table-btn" href='{{url("edit-offer/$parameter")}}' name="button">Edit</a>
    </td>
</tr>