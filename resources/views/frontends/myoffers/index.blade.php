@extends('frontends.layouts.master')

@section('content')

<!--container-->
    <div class="container  mb-9 my-offer" id="cryp_resize">
        <div class="row">
            @include('includes.partials.messages')   
        </div>
        <!--myoffer-->
        <div class="col-md-6">
            <h3>My offers</h3>
            <p>Offer is an advertisement to buy and sell cryptocurrecy, which is pegged to cryptocurrencies exchange rates. If you create an offer, your transaction charge will be 0.75% and responding party will pay 0.25%</p>
            @if(count($trades) == 0)
            <div class="mt-4">
                <a class="btn create-btn" href="{{url('new-offer')}}" name="button">CREATE NEW OFFER</a>
            </div>
            @endif
        </div>
        @if(count($trades) > 0)
        <div class="col-md-4 mt-3 col-md-offset-2 text-right">
            <a class="btn create-btn" href="{{url('new-offer')}}" name="button">CREATE NEW OFFER</a>
        </div>
        @endif

        
        <!--myoffer table-->
        <div class="table-responsive">
            <!--table-->
            <table class="table table-striped mt-15">
                <!--thead-->
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Payment</th>
                        <th>Location</th>
                        <th>Limit</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <!--thead-->
                <!--tbody-->
                <tbody>

                    @forelse ($trades as $key => $value)

                        @include("frontends.parts.myoffers.singlerow")
                    @empty
                        <tr>
                            <td colspan="6" class="text-center"><strong>No Records Found</strong></td>
                        </tr>
                    @endforelse
                   <!--  <tr>
                        <td>Selling</td>
                        <td><strong>Paypal</strong></td>
                        <td>Indore, Madhya Pradesh, IN</td>
                        <td>up to 1,000</td>
                        <td> 67,587.00</td>
                        <td class="text-center">
                            <button class="btn pause-btn" type="submit" name="button"><i class="fa fa-pause"></i>&emsp;PAUSE </button>
                            <button class="btn table-btn" type="submit" name="button">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Selling</td>
                        <td><strong>Paypal</strong></td>
                        <td>Indore, Madhya Pradesh, IN</td>
                        <td>up to 1,000</td>
                        <td> 67,587.00</td>
                        <td class="text-center">
                            <button class="btn pause-btn" type="submit" name="button"><i class="fa fa-pause"></i>&emsp;PAUSE </button>
                            <button class="btn table-btn" type="submit" name="button">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Selling</td>
                        <td><strong>Paypal</strong></td>
                        <td>Indore, Madhya Pradesh, IN</td>
                        <td>up to 1,000</td>
                        <td> 67,587.00</td>
                        <td class="text-center">
                            <button class="btn pause-btn" type="submit" name="button"><i class="fa fa-pause"></i>&emsp;PAUSE </button>
                            <button class="btn table-btn" type="submit" name="button">Edit</button>
                        </td>
                    </tr> -->
                </tbody>
                <!--tbody-->
            </table>
            <!--table-->
        </div>
        <!--myoffer table-->
    </div>
    <!--container-->
     @push("after-scripts")
        <script type="text/javascript">
            function updateTradeStatus(id, value){
                var resumeId = "#resume_"+id;
                var pauseId = "#pause_"+id;
                var rowId = "#row_"+id;
                $.ajax({
                    async: false,
                    type: "POST",
                    data: { "_token": token, "id":id, "is_paused":value },
                    dataType: "html", // or html if you want...
                    url: host + "/update-offer-status", // you need change it.
                    // processData: false,
                    headers: { 'X-CSRF-TOKEN': token },
                    // contentType: false,
                    success: function(result) {
                        // location.href = host+"/my-offers";
                        // if(value == 1)
                        // {
                        //     $(pauseId).hide();
                        //     $(resumeId).show();
                        // }else{
                        //     $(pauseId).show();
                        //     $(resumeId).hide();
                        // }

                        $(rowId).empty();
                        $(rowId).replaceWith(result);
                    },
                    timeout: 10000
                });
            }
     
        </script>
    @endpush

@endsection