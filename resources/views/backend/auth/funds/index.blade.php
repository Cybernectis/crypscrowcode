@extends ('backend.layouts.app')

@section ('title', app_name() . ' | '. __('labels.backend.access.funds.management'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.funds.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                @include('backend.auth.funds.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>{{ __('labels.backend.access.funds.table.coin') }}</th>
                                <th>{{ __('labels.backend.access.funds.table.date') }}</th>
                                 <th>Transaction Hash</th>
                                <th>{{ __('labels.backend.access.funds.table.from_address') }}</th>
                                <th>{{ __('labels.backend.access.funds.table.to_address') }}</th>
                                <th>{{ __('labels.backend.access.funds.table.balance') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @forelse ($transactions as $result )
                                <tr>
                                    <td>{{$i++}}</td> 
                                    <td>{{Helper::getLocalCoinName($result->local_coins_id, 'short_name')}}</th>
                                    <td>{{$result->created_at}}</td>  
                                    <td>{{$result->hash}}</td>  
                                    <td>{{$result->from_address}}</td>  
                                    <td>{{$result->to_address}}</td>
                                    <td>{{$result->amount}}</td>                  
                                </tr>
                            @empty
                            <tr>                        
                                <td colspan="5">No Record Found</td>
                            </tr>
                            @endforelse
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
                    {!!$transactions->links()!!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Transfer Fund From One Wallet To Other</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="selected_coin">Select Coin:</label>
                        <select class="form-control" name="selected_coin" onchange="getSelectedCoinWallet(this.options[this.selectedIndex].getAttribute('value'),'{{$logged_in_user->id}}')">
                            <option>Select Coin</option>
                            @forelse ($localCoin as $value)
                                <option value="{{ $value->id }}" coin_name="{{$value->short_name}}">{{ $value->name }}-{{$value->short_name}}</option>
                            @empty
                                
                            @endforelse
                                                           
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input class="form-control" type="text"  name="amount" placeholder="e.g. 0.001">
                    </div>
                    <div class="form-group">
                        <label for="reciever_address">To Address:</label>
                        <input class="form-control" type="text"  name="reciever_address" placeholder="Enter Reciever Address">
                    </div>
                    <div class="form-group">
                        <label for="sender_address">From Address:</label>
                        <input type="text" name="sender_address" class="form-control" placeholder="Enter Sender Address">
                    </div>
                    <div class="form-group">
                        <label for="sender_private_key">Private Key:</label>
                        <input type="text" name="sender_private_key" class="form-control" value="" placeholder="Enter Sender private key">
                    </div>
                    <div class="form-group">
                        <label for="network_fees">Network fees:</label>
                        <input type="text" name="network_fees" class="form-control" value="">
                    </div>
                      
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn create-btn" id="send_assets_to_other_wallet" disabled>Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div><!--card-->
@push("after-scripts")
    <script>
        var transactionData = '';
        function getSelectedCoinWallet(coin_id=null,user_id)
        {
            if(coin_id!='' && typeof(coin_id)!='undefined')
            {

                var data = { 
                                coin_id:coin_id,
                                _token:"{{csrf_token()}}",
                                user_id:user_id,
                                is_admin:1
                            }
                axios.post(host+'/get-coin-wallet',data).then(response => {
                    console.log(response.data);
                    $('input[name="sender_address"]').val(response.data.address);

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
                            console.log(coin_id);
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

                            axios.post(host+'/storeEscrowTransaction',serverdata ).then(function(response)
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

