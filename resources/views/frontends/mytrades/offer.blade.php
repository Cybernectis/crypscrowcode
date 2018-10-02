@extends('frontends.layouts.master')

@section('content')
<!--container-->
    <div class="container  mb-5 view" id="myapp">
        <!--trems--> 
        <div class="row mb-3">
            <div class="col-md-6 ">
            	@php 
                	$username = $trade->userData()->value('username')
                @endphp
                
                                
                <h4><b>{{($trade->userOfferTrades()->value('id') == 1) ? "Sell To" : "Buy from"}} <a href='{{url("profile/$username")}}'><b>{{$username}}</b></a></b></h4>
                @php 
                	$users = $trade->userData;
                @endphp
                <form class="offer-form" style=" " >
			        <strong>Trade amount</strong>
			        <h5>Limits: {{Helper::getDisplayTradeLimit($trade->id)}}</h5>
			       @auth
               		<create-group :initial-users="{{$users}}" ></create-group>
                    @endauth
                    @guest
                        <div class="form-group">
                            <input type="number" class="form-control" name="amount"  placeholder="{{$trade->userLocalCurrency()->value('short_name')}}" id="amount">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="coin_quantity" placeholder="Cryptocoin" id="coin_quantity" >
                        </div>
                        
                         <div class="form-group" >
                            <a href="{{url('register')}}">
                               <button type="button"  class="btn create-btn" style="width: 100%">Signup</button>
                           </a>
                        </div>

                    @endguest
           			<p class="font-12">You'll be able to discuss the payment details with the seller using end-to-end encryption.</p>
    			</form>
                <hr>
               
                <h5><b><i class="fa fa-lock"></i>&nbsp; Encrypted chat</b></h5>
                <p class="light-section">Once you open a trade, messages are end-to-end encrypted so your privacy is protected. The only case where we can read your messages is if either party initiates a dispute.</p>
            </div>
            <div class="col-md-6" style="border-left: 1px solid grey;padding: 1% 4%;line-height: 2;">
            	@php 
            		$userType = "";
            		if($trade->offer_type_id == 1)
            		{
                        $userType = "seller";
                        $owenerType = "buyer";
            		}else{
            			$userType = "buyer";
                        $owenerType = "seller";
            		}
            	@endphp
                <p class="text-center">You are the <b>{{$userType}}</b></p>
                <hr>
                <h4 class="text-center">1 {{$trade->getlocalcoin->short_name}} = <b>{{$trade->userLocalCurrency->short_name}} {{$trade->crypscrow_price}}</b> {{$trade->userLocalCurrency->full_name}}</h4>
                <br>
                <p class="text-center font-12">The {{$owenerType}} chose this price — only continue if you’re comfortable with it. This rate includes crypscrow's {{$trade->getlocalcoin->creator_percentage}}% fee.</p>
                <hr>
                <strong>Terms of trade with {{$username}}</strong>
                <p class="font-12">
                	{{$trade->terms_of_trades}}
                </p>
                <hr>
                <div class="col-md-12">
                    <div class="col-md-5 text-right"><strong>Username</strong></div>
                    <div class="col-md-7"><a href='{{url("profile/$username")}}'>{{$username}}</a></div>
                    <div class="col-md-5 text-right"><strong>Identity key</strong></div>
                    <div class="col-md-7"><i class="fa fa-user"></i>&emsp;{{$trade->userData()->value('uuid')}}</div>
                    <div class="col-md-5 text-right"><strong>Registered</strong></div>
                    <div class="col-md-7">{{ $trade->userData()->value('created_at')->timezone(get_user_timezone())->format('F jS, Y') }}</div>
                    <!-- <div class="col-md-5 text-right"><strong>Trades</strong></div> -->
                    <!-- <div class="col-md-7">585+</div> -->
                   <!--  <div class="col-md-5 text-right"><strong>Volume</strong></div>
                    <div class="col-md-7">~175 ETH</div>
                    <div class="col-md-5 text-right"><strong>Good feedback</strong></div>
                    <div class="col-md-7">100%</div> -->
                    <div class="col-md-5 text-right"><strong>Email verified</strong></div>
                    <div class="col-md-7">
                    	@if($trade->userData()->value('confirmed'))
                    		Yes 
                		@else 
                		No
                		@endif
                    </div>
                    <div class="col-md-5 text-right"><strong>Phone verified</strong></div>
                    <div class="col-md-7">
                        @if($trade->userData()->value('phone_confirmed'))
                            Yes 
                        @else 
                        No
                        @endif
                    </div>
                    <!-- <div class="col-md-5 text-right"><strong>Phone verified</strong></div>
                    <div class="col-md-7">Yes</div> -->
                </div>
            </div>
        </div>
        <!--trems-->
    </div>
    <!--container-->
    @push("after-scripts")
    	<script type="text/javascript">
    		$("#amount").attr("placeholder", "{{$trade->userLocalCurrency()->value('short_name')}}");
    		var name = "{{ (Auth::check() ? $logged_in_user->username:'').'-'.$username}}";
    		var trade_id = "{{$trade->id}}";
            var offer_type_id = "{{$trade->offer_type_id}}";
            var local_coins_id = "{{$trade->local_coins_id}}";
            var coinQuantity = "";
            $("#amount").attr("min", "{{!empty($trade->minimum_limit) ? $trade->minimum_limit :'' }}");
            $("#amount").attr("max", "{{!empty($trade->maximum_limit) ? $trade->maximum_limit : ''}}");
    		 // $("input:hidden").val(name);
            $(document).on('blur','input[name="amount"]',function(e){ 
                e.preventDefault();
                var investamount  = parseFloat($(this).val());
                var minvalue  = parseFloat($(this).attr('min'));
                var maxvalue  = parseFloat($(this).attr('max'));
                if(minvalue == '' || typeof minvalue == 'undefined' || maxvalue =='' || typeof maxvalue == 'undefined')
                {
                    if(minvalue == '' || typeof minvalue == 'undefined')
                    {
                        minvalue = 0;
                    }
                    if(maxvalue != '' || typeof maxvalue != 'undefined')
                    {   
                        if( investamount > maxvalue)
                        {
                        
                            swal("Please Select Valid Range", "You Enter Wrong Value!", "error");
                            $(this).val('');
                            $('#coin_quantity').val('');


                        }
                    }
                }
                else
                {
                    
                    if(investamount < minvalue || investamount > maxvalue)
                    {
                        
                        swal("Please Select Valid Range", "You Enter Wrong Value!", "error");
                        $(this).val('');
                        $('#coin_quantity').val('');

                    }
                    
                }
            });
            $(document).on('keyup','input[name="amount"]',function(e){
                e.preventDefault();
                var investamount   = parseFloat($(this).val());
                
                axios.get(host+'/calculate-coin/'+trade_id+'/'+investamount)
                .then(function (response) {
                    console.log(response.data);
                    $("#coin_quantity").val(response.data);
                    coinQuantity = response.data;
                    $('input[name="coin_quantity"]').val(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
            });


    	</script>
    @endpush
@endsection