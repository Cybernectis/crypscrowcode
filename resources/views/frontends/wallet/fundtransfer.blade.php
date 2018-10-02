@extends('frontends.layouts.master')

@section('content')
 <!--container-->
    <div class="container  mb-9 my-trades" id="cryp_resize">
        
        <h3> Manage Fund</h3>
                        
            <button class="btn create-btn pull-right" data-toggle="modal" data-target="#myModal">Transfer Fund</button>
        

        <div class="table-responsive ">
            
            <!--table-->
            <table class="table table-striped mt-3 mb-4">
                <!--thead-->
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Coin</th>
                        <th>Date</th>  
                        <th>From Address</th>  
                        <th>To Address</th>        
                        <th>Balance</th>                   
                    </tr>
                </thead>
                <!--thead-->
                <!--tbody-->
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @forelse ($transaction as $result )
                        <tr>
                            <td>{{$i++}}</td> 
                            <td>{{Helper::getLocalCoinName($result->local_coins_id, 'short_name')}}</td>
                            <td>{{$result->created_at}}</td>  
                            <td>{{$result->from_address}}</td>  
                            <td>{{$result->to_address}}</td>
                            <td>{{$result->amount}}</td>                  
                        </tr>
                    @empty
                    <tr>                        
                        <td colspan="6">No Record Found</td>
                    </tr>
                    @endforelse
                                   
                </tbody>
                <!--tbody-->
            </table>
            <!--table-->
        </div>
        <!--active trades table-->
        
    </div>
    <!--container-->
     <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Transfer Fund From One Wallet To Other</h4>
        </div>
        <div class="modal-body">
                        <p>Select Coin</p>
                        <p>
                            <select class="form-control" name="selected_coin" onchange="getSelectedCoinWallet(this.options[this.selectedIndex].getAttribute('value'),'{{$logged_in_user->id}}')">
                                <option>Select Coin</option>
                                @forelse ($localCoin as $value)
                                    <option value="{{ $value->id }}" coin_name="{{$value->short_name}}">{{ $value->name }}-{{$value->short_name}}</option>
                                @empty
                                    
                                @endforelse
                                                               
                            </select>
                        </p>
                        <p>Amount</p>
                        <p>
                            <input class="form-control" type="text"  name="amount" placeholder="e.g. 0.001"">
                        </p>
                        <p>To Address</p>
                        <p>
                            <input class="form-control" type="text"  name="reciever_address" placeholder="Enter Reciever Address">
                        </p>
                        <p>From Address</p>
                        <p>
                            <input type="text" name="sender_address" class="form-control" placeholder="Enter Sender Address">
                        </p>
                        <p>Private Key</p>
                            <input type="text" name="sender_private_key" class="form-control" value="" placeholder="Enter Sender private key">
                        
                        <p>Network fees</p>
                        <p>
                            <input type="text" name="network_fees" class="form-control" value="">
                        </p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn create-btn" id="send_assets_to_other_wallet" disabled>Send</button>
                        
                    </div>
      </div>
      
    </div>
  </div>
    @push("after-scripts")
    <script>
        var transactionData = '';
        function getSelectedCoinWallet(coin_id=null,user_id)
        {
            if(coin_id!='' && typeof(coin_id)!='undefined')
            {

                var data = { 
                                coin_id:coin_id,
                                _token:token,
                                user_id:user_id
                            }
                axios.post(host+'/get-coin-wallet',data).then(response => {
                    console.log(response.data);
                    $('input[name="sender_address"]').val(response.data.wallet_address);

                });
            }
        }
        $(document).on('keyup','input[name="sender_private_key"]',function(){
            
            var sender_private_key      = $(this).val();
            var sender_address          = $('input[name="sender_address"]').val();
            var coin                = $('input[name="selected_coin"]').attr('coin_name');

            var amount            = parseInt($('input[name="amount"]').val());
            
            var reciever_address  = $('input[name="reciever_address"]').val();
            if(sender_address != '' || reciever_address != '')
            {

                window.keys = new bitcoin.ECPair(bigi.fromHex(sender_private_key));

                    var newtx = {
                        inputs: [{ addresses: [sender_address] }],
                        outputs: [{ addresses: [reciever_address], value: amount }]
                    };
                // calling the new endpoint, same as above
                axios.post('https://api.blockcypher.com/v1/bcy/test/txs/new', JSON.stringify(newtx),{
                        transformRequest: [function(data, headers) {
                            
                            delete headers['X-Socket-Id'];
                            delete headers['common']['X-CSRF-TOKEN'];
                            return data;
                        }]
                    })
                .then(function(tmptx) {
                    console.log(tmptx);
                    
                        $('input[name="network_fees"]').val(tmptx.data.tx.fees);                
                        transactionData = tmptx.data;
                        $('#send_assets_to_other_wallet').removeAttr('disabled');
                        $('#send_assets_to_other_wallet').attr('transactionData',transactionData);
                        swal({
                          title: "Network Fees Calculate!",
                          text: 'Please click on send button to continue transaction',
                          icon: "info",
                        });
                    
                })
                .catch(function(error){
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
                      title: "Oops you missed some feild !",
                      text: errors,
                      icon: "warning",
                    });

            }
          
            
        });
        $(document).on('click', '#send_assets_to_other_wallet',function(e){
            e.preventDefault()
            if(transactionData)
            {
                var data = transactionData;
                // function sendDataValue(transactionData)
                // {
                    
                    data.pubkeys = [];
                    data.signatures = data.tosign.map(function(tosign, n) {
                        data.pubkeys.push(keys.getPublicKeyBuffer().toString("hex"));
                        return keys.sign(new buffer.Buffer(tosign, "hex")).toDER().toString("hex");
                    });

                    axios.post('https://api.blockcypher.com/v1/bcy/test/txs/send', JSON.stringify(data), 
                    {
                        transformRequest: [function(data, headers) {
                            
                            delete headers['X-Socket-Id'];
                            delete headers['common']['X-CSRF-TOKEN'];
                            return data;
                        }]
                    }).then(function(response) {
                        // console.log('guarav'+response);
                        if(response.data !='')
                        {
                            var sender_address          = $('input[name="sender_address"]').val();
                            var coin_id               = $('input[name="selected_coin"]').val();
                            
                            var amount            = parseInt($('input[name="amount"]').val());
                            
                            var reciever_address  = $('input[name="reciever_address"]').val();
                            var network_fees      = parseInt($('input[name="network_fees"]').val());
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

                            axios.post(host+'/storeTransaction',serverdata ).then(function(response)
                                {
                                    if(response.data == "success")
                                    {
                                        swal({
                                              title: "Success",
                                              text: "Fund Transfer Successfully!",
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
                    });
                    
                
            }

        });
        
    </script>
    @endpush
@endsection