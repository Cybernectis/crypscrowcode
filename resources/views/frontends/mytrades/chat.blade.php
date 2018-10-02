@extends('frontends.layouts.master')

@section('content')

<!--container-->
<style type="text/css">


.note {
  width: 11em;
  min-height: 8em;
  background: #4a4a4a;
  position: relative;
  /*filter: drop-shadow(3px 3px 10px rgba(0, 0, 0, 0.8));*/
  transform: rotate(0deg) ;
  top:90%;
  /*left: 50%;*/
}
.note:before {
  content: "";
  position: absolute;
  right: 2em;
  bottom: -2em;
  left: 0;
  border: 1em solid #4a4a4a;
  z-index: -1;
}
.note:after {
  content: "";
  position: absolute;
  right: 0;
  bottom: -2em;
  border-width: 2em 2em 0 0;
  border-style: solid;
  border-color: #4a4a4a transparent;
  filter: drop-shadow(-4px 5px 9px rgba(0, 0, 0, 0.5));
}

.textareaNote {
  font: italic 1.2em Georgia, Times, serif;
  background: transparent;
  width: 8.4em;
  color: white;
  /*height: 5.8em;*/
  margin: 20% 0.8em 0 0.8em;
  padding: 0;
  border: 0;
  overflow: hidden;
  letter-spacing: -1px;
  outline-style: none;
  resize: none;
}

    </style>
    <div class="container  mb-5 view" >
        <!--trems-->
        @if($error)
        @php 
            $userNotId = $groups->users->where('id', '<>', $logged_in_user->id)->pluck('id');
            $username = Helper::getUsername($userNotId[0]);

            if(!empty($groups->amount))
            {
                $invest_amount  = (float)$groups->amount;
                $offer_rate     = (float)$groups->tradeData->price;
                $get_unit_value = 1;
                $unit_vale_price= bcdiv($offer_rate,$get_unit_value,18);
                if($unit_vale_price > 0)
                {

                    $quantity       = bcdiv($invest_amount,$unit_vale_price,18);
                }
                else
                {
                    $quantity = 0;
                }

                
            }
            $textMessageOfBottom = "";
        @endphp

        <div id="myapp">
           
            <div class="row mb-3">
                <div class="col-md-7 ">
                     
                    <h3>Trade partner <a href='{{url("profile/$username")}}'><b>{{$username}}</b></a></h3>
                    @php

                    $today = \Carbon\Carbon::now();
                    @endphp
                    @if(!empty($groups->cancel_date) && ($groups->cancel_date > $today))
                      <div class="alert alert-danger">
                          The private key to this chat will be destroyed in  {{\Carbon\Carbon::createFromTimeStamp(strtotime($groups->cancel_date))->diffForHumans()}}
                      </div>

                   
                    @endif

                    
                  @if(!empty($groups->cancel_date) && $groups->cancel_date < $today)
                    
                    <div class="well">
                      The private key for this chat has been destroyed.
                      <br>

                      Chat is no longer available.
                    </div>
                    @else 
                    <groups :initial-groups="{{ $groups }}" :user="{{ $user }}" ></groups> 
                  @endif  
                
                </div>
                <div class="col-md-5" style="border-left: 1px solid grey">
                    <h4 class="text-center">{{$groups->tradeData->userPaymentMethod()->value('name')}}</h4> 
                    <hr>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <strong>State</strong>

                            
                            @if(($groups->tradeData->user_id == $logged_in_user->id) && ($groups->tradeData->offer_type_id == 2) && ($groups->status == "Waiting for escrow"))
                                <h3>Waiting for funds.</h3>
                                <p>You should only deposit {{$groups->tradeData->getlocalcoin()->value('name')}} to the escrow smart contract once you have made contact with the buyer and the terms have been agreed upon.</p>
                                <button class="btn fund-escrow" type="button" name="button" style="width: 100%" data-toggle="modal" data-target="#myModal">Fund escrow</button>
                                @php
                                    $textMessageOfBottom = "As the seller, you must deposit your {{$groups->tradeData->getlocalcoin()->value('name')}}  into an Crypscrow smart contract. This provides proof-of-funds and allows an arbitrator to resolve any potential dispute.";
                              @endphp
                            @elseif(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 1) && ($groups->status == "Waiting for escrow"))
                                <h3>Waiting for funds.</h3>
                                <p>You should only deposit {{$groups->tradeData->getlocalcoin()->value('name')}} to the escrow smart contract once you have made contact with the buyer and the terms have been agreed upon.</p>
                                <button class="btn fund-escrow" type="button" name="button" style="width: 100%" data-toggle="modal" data-target="#myModal">Fund escrow</button>
                                @php
                                $textMessageOfBottom = "As the seller, you must deposit your {{$groups->tradeData->getlocalcoin()->value('name')}}  into an Crypscrow escrow smart contract. This provides proof-of-funds and allows an arbitrator to resolve any potential dispute.";
                                @endphp
                            @elseif(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 2) && ($groups->status == "Waiting for escrow"))
                                <h3>Waiting for funds.</h3>
                                <p>Waiting for the seller to deposit {{$groups->tradeData->getlocalcoin()->value('name')}} to the escrow smart contract. Don't send anything to the seller before funds are in escrow.</p>
                                @php
                                $textMessageOfBottom = "As the buyer, you must wait. This provides proof-of-funds and allows an arbitrator to resolve any potential dispute.";
                                @endphp
                            @elseif(($groups->tradeData->user_id == $logged_in_user->id) && ($groups->tradeData->offer_type_id == 1) && ($groups->status == "Waiting for escrow"))
                                <h3>Waiting for funds.</h3>
                                <p>Waiting for the seller to deposit {{$groups->tradeData->getlocalcoin()->value('name')}} to the escrow smart contract. Don't send anything to the seller before funds are in escrow.</p>
                                @php
                                 $textMessageOfBottom = "As the buyer, you must wait. This provides proof-of-funds and allows an arbitrator to resolve any potential dispute.";
                                 @endphp
                            @elseif(($groups->tradeData->user_id == $logged_in_user->id) && ($groups->tradeData->offer_type_id == 2) && ($groups->status == "Payment pending"))
                                <h3>{{$groups->status}}</h3>
                                <p>Kindly click on acknowledge payment button as soon as buyer  transfers the payment.</p>
                                <!-- <button class="btn fund-escrow" type="button" name="button" style="width: 100%"  onclick="confirmedPaymentBox({{$groups->id}})">
                                    Confirmed Payment
                                </button> -->
                                  @php
                                $textMessageOfBottom = "Once buyer submit payment you have to confirm it.";
                                @endphp
                            @elseif(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 1) && ($groups->status == "Payment pending"))
                                <h3>{{$groups->status}}</h3>
                                <p>Kindly click on acknowlege payment button as soon as buyer  transfers the payment.</p>
                                <button id="complete_trade_button" class="btn fund-escrow" type="button" name="button" style="width: 100%"  onclick="confirmedPaymentBox({{$groups->id}})">
                                    Confirmed Payment
                                </button>
                                  @php
                                $textMessageOfBottom = "Once you recieved payment click on following button to confirm then escrow will transfer amount to buyer";
                                @endphp
                            @elseif(($groups->tradeData->user_id == $logged_in_user->id) && ($groups->tradeData->offer_type_id == 1) && ($groups->status == "Payment pending"))
                                <h3>{{$groups->status}}</h3>
                                <p>Once you seller confirmed payment recieved {{$groups->tradeData->getlocalcoin()->value('name')}} will transfer to your account</p>
                                @php
                                 $textMessageOfBottom = "Once you seller confirmed payment recieved {{$groups->tradeData->getlocalcoin()->value('name')}} will transfer to your account";
                                   @endphp

                            @elseif(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 2) && ($groups->status == "Payment pending"))
                            <h3>{{$groups->status}}</h3>
                                <p>Once payment deposit is done by you then it will confirm by seller and escrow will transfer {{$groups->tradeData->getlocalcoin()->value('name')}} to your account.</p>
                                <button class="btn fund-escrow" type="button" name="button" style="width: 100%"  onclick="DepositPayment({{$groups->id}})">
                                    Deposit Payment
                                </button>
                               @php
                                $textMessageOfBottom = "Once payment deposit is done by you then it will confirm by seller and escrow will transfer {{$groups->tradeData->getlocalcoin()->value('name')}} to your account.";
                                @endphp

                            @elseif(($groups->tradeData->user_id == $logged_in_user->id) && ($groups->tradeData->offer_type_id == 2) && ($groups->status == "Acknowledge Payment"))
                                <h3>{{$groups->status}}</h3>
                                <p>On receipt of payment click on acknowledge payment button below to confirm transaction as complete.</p>
                                <button id="complete_trade_button" class="btn fund-escrow" type="button" name="button" style="width: 100%"  onclick="confirmedPaymentBox({{$groups->id}})">
                                    Acknowledge Payment
                                </button>
                                  @php
                                $textMessageOfBottom = "On receipt of payment click on acknowledge payment button below to confirm transaction as complete.";
                                @endphp
                            @elseif(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 2) && ($groups->status == "Acknowledge Payment "))
                                <h3>{{$groups->status}}</h3>
                                <p>Once payment confirmation is done by seller escrow will transfer {{$groups->tradeData->getlocalcoin()->value('name')}} to your account.</p>
                               @php
                                $textMessageOfBottom = "Once payment confirmation is done by seller escrow will transfer {{$groups->tradeData->getlocalcoin()->value('name')}} to your account.";
                                @endphp
                            @elseif(($groups->tradeData->user_id == $logged_in_user->id) && ($groups->tradeData->offer_type_id == 1) && ($groups->status == "Acknowledge Payment"))
                                <h3>{{$groups->status}}</h3>
                                <p>On receipt of payment click on acknowledge payment button below to confirm transaction as complete.</p>
                                <button id="complete_trade_button" class="btn fund-escrow" type="button" name="button" style="width: 100%"  onclick="confirmedPaymentBox({{$groups->id}})">
                                    Acknowledge Payment
                                </button>
                                  @php
                                $textMessageOfBottom = "On receipt of payment click on acknowledge payment button below to confirm transaction as complete.";
                                @endphp
                            @elseif(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 1) && ($groups->status == "Acknowledge Payment"))
                                <h3>{{$groups->status}}</h3>
                                <p>Once payment confirmation is done by seller escrow will transfer {{$groups->tradeData->getlocalcoin()->value('name')}} to your account.</p>
                               @php
                                $textMessageOfBottom = "Once payment confirmation is done by seller escrow will transfer {{$groups->tradeData->getlocalcoin()->value('name')}} to your account.";
                                @endphp
                            @elseif(($groups->tradeData->user_id == $logged_in_user->id) && ($groups->tradeData->offer_type_id == 1) && ($groups->status == "Confirmed Payment"))
                                <h3>{{$groups->status}}</h3>
                                <p>Congratulations you successfully completed your trade</p>
                                @php
                                $textMessageOfBottom = "Congratulations you successfully completed your trade";
                                 @endphp
                             @elseif(($groups->tradeData->user_id == $logged_in_user->id) && ($groups->tradeData->offer_type_id == 2) && ($groups->status == "Confirmed Payment"))
                                <h3>{{$groups->status}}</h3>  

                                <p>Congratulations you successfully completed your trade</p> 
                                @php
                                $textMessageOfBottom = "Congratulations you successfully completed your trade";
                                @endphp
                            @elseif(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 2) && ($groups->status == "Confirmed Payment"))
                                <h3>{{$groups->status}}</h3>
                                <p>Congratulations you successfully completed your trade</p>
                                @php
                                $textMessageOfBottom = "Congratulations you successfully completed your trade";
                                @endphp

                            @elseif(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 1) && ($groups->status == "Confirmed Payment"))
                                <h3>{{$groups->status}}</h3>   
                                <p>Congratulations you successfully completed your trade</p>
                                @php
                                $textMessageOfBottom = "Congratulations you successfully completed your trade";
                                @endphp
                            @else 
                             <h3>{{$groups->status}}</h3> 
                            @endif

                                <!-- <button class="btn fund-escrow" type="button" name="button" style="width: 100%" disabled>Waiting for Escrow</button> -->
                           
                            <!-- <p>Once escrow is funded, the buyer has <strong>2 hours</strong> to make payment to you.</p> -->
                        </div>
                        <div class="col-md-4">
                            <strong>Terms</strong>
                           <h3>{{$groups->tradeData->getlocalcoin()->value('short_name')}}-{{number_format($groups->coin_quantity,4)}}</h3>
                            <p>for</p>
                            <h3>{{ $groups->tradeData->userLocalCurrency()->value('short_name')." ". $groups->amount}}</h3>
                        </div>
                    </div>
                    <hr>
                    
                    <ol>
                        <!-- for buy -->
                        <!-- for seller -->
                        @if(($groups->tradeData->user_id == $logged_in_user->id)&& ($groups->tradeData->offer_type_id == 2))
                          
                          <li>The trade has been started</li>
                          <!-- seller conditions -->
                          @if($groups->status == "Waiting for escrow" || $groups->status == "Payment pending" ||$groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>Awaiting for smart contract account to be funded. </li>
                          @endif

                          @if($groups->status == "Payment pending" ||$groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>The smart contract account has been funded. </li>
                          @endif
                          @if($groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>
                            Trade has been marked as complete.
                          </li>
                          @endif
                          @if($groups->status == "Confirmed Payment")
                          <li>
                            Waiting for the Network to confirm the release.
                          </li>
                          <li>
                            Transaction completed on Network.
                          </li>
                          @endif

                        @endif
                        <!-- for buyer -->
                        @if(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 2  ))
                          <li>You have initiated the trade {{\Carbon\Carbon::createFromTimeStamp(strtotime($groups->created_at))->diffForHumans()}}.</li>
                          
                          @if($groups->status == "Waiting for escrow" || $groups->status == "Payment pending" ||$groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>Waiting for seller to fund smart contract account. </li>
                          @endif

                          @if($groups->status == "Payment pending" ||$groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>Seller has funded the smart contract account. </li>
                          @endif
                          @if($groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>
                            Trade has been marked as paid by you.
                          </li>
                          @endif
                          @if($groups->status == "Confirmed Payment")
                          <li>
                            Waiting for the Network to confirm the release.
                          </li>
                          <li>
                            Transaction completed on Network.
                          </li>
                          @endif
                        @endif

                        <!-- for sell -->
                        <!-- for buy -->
                        <!-- for seller -->
                        @if(($groups->tradeData->user_id == $logged_in_user->id)&& ($groups->tradeData->offer_type_id == 1))
                          
                          <li>The trade has been started</li>
                          <!-- seller conditions -->
                          @if($groups->status == "Waiting for escrow" || $groups->status == "Payment pending" ||$groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>Awaiting for smart contract account to be funded. </li>
                          @endif

                          @if($groups->status == "Payment pending" ||$groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>The smart contract account has been funded. </li>
                          @endif
                          @if($groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>
                            Trade has been marked as complete.
                          </li>
                          @endif
                          @if($groups->status == "Confirmed Payment")
                          <li>
                            Waiting for the Network to confirm the release.
                          </li>
                          <li>
                            Transaction completed on Network.
                          </li>
                          @endif

                        @endif
                        <!-- for buyer -->
                        @if(($groups->tradeData->user_id != $logged_in_user->id) && ($groups->tradeData->offer_type_id == 1  ))
                          <li>You have initiated the trade {{\Carbon\Carbon::createFromTimeStamp(strtotime($groups->created_at))->diffForHumans()}}.</li>
                          
                          @if($groups->status == "Waiting for escrow" || $groups->status == "Payment pending" ||$groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>Waiting for seller to fund smart contract account. </li>
                          @endif

                          @if($groups->status == "Payment pending" ||$groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>Seller has funded the smart contract account. </li>
                          @endif
                          @if($groups->status == "Acknowledge Payment" ||$groups->status == "Confirmed Payment")
                          <li>
                            Trade has been marked as paid by you.
                          </li>
                          @endif
                          @if($groups->status == "Confirmed Payment")
                          <li>
                            Waiting for the Network to confirm the release.
                          </li>
                          <li>
                            Transaction completed on Network.
                          </li>
                          @endif
                        @endif
                        
                    </ol>
                    <hr>
                    <div class="col-md-12">
                        <p>Escrow smart contract</p>
                        <div class="col-md-5" >
                            <div class="note">
                                <textarea class="textareaNote" name="note" spellcheck="false" readonly="">
                                    {{$groups->status}}
                                </textarea>

                            </div>
                        </div>
                        <div class="col-md-7 clearfix">
                          <br><br>
                            <p>{{$textMessageOfBottom}}</p>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div >
                            @if(($groups->status == "Payment pending") || ($groups->status == "Waiting for escrow"))
                            <button class="btn Cancel-view" type="button" style="width:100%"  onclick='cancelTrade("{{$groups->id}}")' id="cancelTrade">Cancel trade</button>
                            @endif
                            @if(($groups->status == "Payment pending") || ($groups->status == "Waiting for escrow"))
                            <button class="btn Cancel-view" type="button" style="width:100%"  onclick='createDispute("{{$groups->id}}")' id="createDispute">Create Dispute</button>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Funded Escrow</h4>
                    </div>
                    <div class="modal-body">
                       <p> Escrow Account</p>
                        <p><input class="form-control" type="text" disabled name="escrow_address" value="{{(!empty($adminwalletdetail->address) ? $adminwalletdetail->address :'')}}"></p>
                        <p>Coin</p>
                        <p>{{$groups->tradeData->getlocalcoin->short_name}}-{{$quantity}}
                            <input type="hidden" name="coin" class="form-control" value="{{$quantity}}" coin_id="{{$groups->tradeData->local_coins_id}}" readonly></p>
                        <p>Private Key</p>
                        <input type="text" name="sender_private_key" class="form-control" value="" placeholder="Enter your private key">
                        <p>From address</p>
                        <input type="text" name="sender_address" class="form-control" value="" placeholder="Enter your {{strtolower($groups->tradeData->getlocalcoin->name)}} address ">
                        <p>Network fees</p>
                        <p><input type="text" name="network_fees" class="form-control" value="" disabled></p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn fund-escrow" id="send_assets_to_escrow">Send</button>
                        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!--trems-->

    </div>
    <!--container-->
    @push('after-scripts')
        @if($error == 0)
            <script type="text/javascript">
                

                swal({
                  title: "On no, an error has occured",
                  text: "You are not a party to that trade.",
                  icon: "warning",
                  buttons: {
                           
                          confirm: {
                            text: "ok",
                            closeModal: true
                          }
                  },
                  dangerMode: true,
                  
                })
                .then((willDelete) => {
                   location.href = "{{url('/')}}";
                });


                
            </script>
        @endif
    <script type="text/javascript">
        var coin_unit_value = "{{$groups->tradeData->getlocalcoin()->value('unit_value')}}";
        var sendData = "";
        var coin_unit_name = "{{$groups->tradeData->getlocalcoin->unit_name}}";
        var network_fees = '';
        var coin_qty = '';
        function confirmedPaymentBox(id)
        {
            
            swal({
              title: "Are you sure you recieved payment",
              text: "As you click on 'OK' your {{$groups->tradeData->getlocalcoin()->value('name') }} will transfer from escrow account to your trade partner account.",
              icon: "info",
              buttons: {
                cancel: "Cancel",
                  confirm: {
                    text: "OK",
                    closeModal: true
                  }
              },
              dangerMode: true,
              
            })
            .then((willDelete) => 
            {
                var url = host + "/get-trade-keys";
                axios.post(url, {'trade_id':"{{$groups->id}}" })
                .then(function(response)
                {
                    if(response.data == null || response.data=='')
                    {
                        swal({
                              title: "Oops some thing is wrong!",
                              text: errors,
                              icon: "warning",
                            });
                    }
                    console.log(response.data);
                    //Code for getting network fee and and sending to user
                    var sender_address      = response.data.adminwalletdetail.address;
                    var sender_private_key  = response.data.adminwalletdetail.private_key;
                    var coin_id             = "{{$groups->tradeData->local_coins_id}}";
                    coin_qty                = parseFloat(response.data.coin_quantity_unit);
                    
                    var escrow_address  = response.data.userWallet.wallet_address;
                    
                    console.log(coin_qty);
                    
                    
                    
                    
                    window.keys = new bitcoin.ECPair(bigi.fromHex(sender_private_key));

                    var newtx = {
                        inputs: [{ addresses: [sender_address] }],
                        outputs: [{ addresses: [escrow_address], value: coin_qty }]
                    };
                        console.log('gaurav='+newtx);

                    // calling the new endpoint, same as above
                    axios.post('https://api.blockcypher.com/v1/bcy/test/txs/new', JSON.stringify(newtx),
                    {
                        transformRequest: [function(data, headers) {
                            
                            delete headers['X-Socket-Id'];
                            delete headers['common']['X-CSRF-TOKEN'];
                            return data;
                        }]
                    })
                    .then(function(tmptx) {
                        $('input[name="network_fees"]').val(tmptx.data.tx.fees);
                        network_fees = tmptx.data.tx.fees;
                        // sendData = tmptx.data;
                        tmptx.data.pubkeys = [];
                        tmptx.data.signatures = tmptx.data.tosign.map(function(tosign, n) {
                            tmptx.data.pubkeys.push(keys.getPublicKeyBuffer().toString("hex"));
                            return keys.sign(new buffer.Buffer(tosign, "hex")).toDER().toString("hex");
                        });

                        axios.post('https://api.blockcypher.com/v1/bcy/test/txs/send', JSON.stringify(tmptx.data), 
                        {
                            transformRequest: [function(data, headers) {
                                
                                delete headers['X-Socket-Id'];
                                delete headers['common']['X-CSRF-TOKEN'];
                                return data;
                            }]
                        })
                        .then(function(response) {
                            if(response.data)
                            {
                                var url = host + "/groups/{{$groups->id}}";
                                axios.post(url, {'_method':'PUT', 'type':'confirmed' }).then(function(response){
                                    if(response.data)
                                    {
                                        swal({
                                          title: "Fund transfer to ",
                                          text: "Trade partner success",
                                          icon: "success",
                                        });
                                        location.href = "{{url('/')}}";
                                    }                                    
                                    
                                });
                            }
                        })                       
                        
                    })
                    .catch(function(error){
                        console.log(error.response);
                        if(error.response.data.errors.length)
                        {
                            var errors = "";
                            for (var i = 0; i < error.response.data.errors.length; i++) 
                            {
                                errors += error.response.data.errors[i].error+", ";
                            }
                            swal({
                              title: "Oops some thing is wrong!",
                              text: errors,
                              icon: "warning",
                            });
                            $("#myModal").modal("hide");
                        }
                    });
                });
            });
    
           

        }
        function createDispute(id)
        {
            
            swal({
              title: "Are you sure you want to create dispute",
              text: "Your private key '{{$groups->uuid}}' will be shared to Support team with you chat history. Agent to look into the dispute will be assigned shortly to take action on receipt of the request. ",
              icon: "warning",
              buttons: {
                cancel: "No, don't create",
                  confirm: {
                    text: "Yes, create the dispute",
                    closeModal: true
                  }
              },
              dangerMode: true,
              
            })
            .then((willDelete) => {
              if(willDelete)
              {
                 var url = host + "/groups/" + id;
                axios.post(url, {'_method':'PUT', 'type':'dispute' }).then(function(response){
                    console.log(response.data);
                    // location.reload();
                    // if (willDelete) {
                    //     swal("Poof! Your trade has been cancelled!", {
                    //       icon: "success",

                    });
              }
               
              
            });

        }

        function DepositPayment(id)
        { 
            swal({
              title: "Payment Deposit ",
              text: "Are you sure? you deposit payment to seller",
              icon: "info",
              buttons: {
                cancel: "No, Not Deposit",
                  confirm: {
                    text: "Yes, Payment Deposit",
                    closeModal: true
                  }
              },
              dangerMode: true,
              
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                          async: false,
                          type: "POST",
                          data: { "_token": token, '_method':'PUT', 'type':'deposit' },
                          dataType: "json", // or html if you want...
                          url: host + "/groups/" + id, // you need change it.
                          success: function(result) {
                              location.reload();
                              
                                  swal("Poof! Your trade has been cancelled!", {
                                    icon: "success",
                                  });
                                
                          },
                          timeout: 10000
                      });
                } else {
                    swal("Your trade is safe!");
                  }
            });

        }

        function cancelTrade(id){
            // e.preventDefault();
            swal({
              title: "Do you want to cancel this trade?",
              text: "You can safely cancel this trade as no escrow smart contract has been created.",
              icon: "warning",
              buttons: {
                cancel: "No, don't cancel",
                  confirm: {
                    text: "Yes, cancel the trade",
                    closeModal: true
                  }
              },
              dangerMode: true,
              
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                          async: false,
                          type: "POST",
                          data: { "_token": token, '_method':'PUT', 'type':'cancel' },
                          dataType: "json", // or html if you want...
                          url: host + "/groups/" + id, // you need change it.
                          success: function(result) {
                              location.reload();
                              
                                  swal("Poof! Your trade has been cancelled!", {
                                    icon: "success",
                                  });
                                
                          },
                          timeout: 10000
                      });
                } else {
                    swal("Your trade is safe!");
                  }
            });
        }
        $(document).on('click','#send_assets_to_escrow',function(e)
        {
            e.preventDefault();
            if(sendData != "")
            {
                sendDataValue(sendData);
            }
            // sendDataValue(sendData);
            
        });

        
  $(document).on('keyup','input[name="sender_address"]',function(){
            
            var sender_address      = $(this).val();
            var sender_private_key  = $('input[name="sender_private_key"]').val();
            var coin_id             = $('input[name="coin"]').attr('coin_id');
             coin_qty            = $('input[name="coin"]').val();
            
            var escrow_address  = $('input[name="escrow_address"]').val();
            console.log(escrow_address);
            var url = host + "/network-fees/" + coin_id;
            
            coin_qty = parseInt(coin_qty * coin_unit_value);
            axios.get(url).then(function(response){
				
                if(response.data)
                {
                    window.keys = new bitcoin.ECPair(bigi.fromHex(sender_private_key));

                    var newtx = {
                        inputs: [{ addresses: [sender_address] }],
                        outputs: [{ addresses: [escrow_address], value: coin_qty }]
                    };

                  var url1 =  "https://api.blockcypher.com/v1/"+"{{ strtolower($groups->tradeData->getlocalcoin()->value('short_name'))}}"+"/"+"{{env('BLOCK_CYPHER_TYPE')}}"+"/txs/new";
                   
                    // calling the new endpoint, same as above
                    axios.post(url1, JSON.stringify(newtx),{
                            transformRequest: [function(data, headers) {
                                
                                delete headers['X-Socket-Id'];
                                delete headers['common']['X-CSRF-TOKEN'];
                                return data;
                            }]
                        })
                    .then(function(tmptx) {
                        console.log(tmptx);
                        
                            $('input[name="network_fees"]').val(tmptx.data.tx.fees);

                            network_fees = tmptx.data.tx.fees;
                            sendData = tmptx.data;
                        
                        
                    }).catch(function(error){
                        console.log(error.response);
                        if(error.response.data.errors.length){
                            var errors = "";
                            for (var i = 0; i < error.response.data.errors.length; i++) {
                                errors += error.response.data.errors[i].error+", ";
                            }
                            swal({
                              title: "Oops some thing is wrong!",
                              text: errors,
                              icon: "warning",
                            });
                            $("#myModal").modal("hide");
                        }
                    });

                }
                else
                {
                    swal({
                      title: "Oops some thing is wrong!",
                      text: "Please Try Again !",
                      icon: "warning",
                    });
                }
                
            });
        });

    function sendDataValue(data)
    {
        //console.log('testing block send');
        data.pubkeys = [];
        data.signatures = data.tosign.map(function(tosign, n) {
            data.pubkeys.push(keys.getPublicKeyBuffer().toString("hex"));
            return keys.sign(new buffer.Buffer(tosign, "hex")).toDER().toString("hex");
        });

        var urlSend = "https://api.blockcypher.com/v1/"+"{{strtolower($groups->tradeData->getlocalcoin()->value('short_name'))}}"+"/"+"{{env('BLOCK_CYPHER_TYPE')}}"+"/txs/send";
      

        axios.post(urlSend, JSON.stringify(data), 
        {
            transformRequest: [function(data, headers) {
                
                delete headers['X-Socket-Id'];
                delete headers['common']['X-CSRF-TOKEN'];
                return data;
            }]
        }).then(function(response) {
            if(response.data !='')
            {
                var sender_address          = $('input[name="sender_address"]').val();
                var coin_id               = $('input[name="coin"]').attr('coin_id');
                
                var amount            =  coin_qty;
                
                var reciever_address  = $('input[name="escrow_address"]').val();
                network_fees      = parseInt(network_fees);
                var serverdata = {
                    sender_address:sender_address,
                    reciever_address:reciever_address,
                    user_id:"{{$logged_in_user->id}}",
                    amount:amount,
                    coin_id:coin_id,
                    network_fees:network_fees,
                    hash:response.data.tx.hash
                }
                console.log(serverdata);

                axios.post(host+'/storeEscrowTransaction',serverdata ).then(function(response)
                    {
                        if(response.data == "success")
                        {
                            var url = host + "/groups/" + "{{$groups->id}}";
                             
                              axios.put(url, { "_token": token, '_method':'PUT', 'type':'payment' })
                                  .then(function(response) {
                                      console.log(response);
                                      location.reload();
                                  })
                                  .catch(function(error){
                                      console.log(error);
                                      console.log(error.response);
                                  });
                              swal({
                                    title: "Success",
                                    text: "Your amount is funded to escrow!",
                                    icon: "success",
                                  });
                              $("#myModal").modal("hide");
                        }
                        else
                        {
                            swal({
                                  title: "warning",
                                  text: "Technical Error! Try again",
                                  icon: "warning",
                                });
                            $("#myModal").modal("hide");
                        }
                    });
            }
                        
            
        }).catch(function(error){ 
            
            if(error.response.data.errors.length){
                var errors = "";
                for (var i = 0; i < error.response.data.errors.length; i++) {
                    errors += error.response.data.errors[i].error+", ";
                }
                swal({
                  title: "Oops some thing is wrong!",
                  text: errors,
                  icon: "warning",
                });
                $("#myModal").modal("hide");
            }
        });;
       

    }
    </script>
    @endpush
    @endsection