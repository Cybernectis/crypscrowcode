@extends('frontends.layouts.master')

@section('content')
 <!--container-->
    <div class="container  mb-9 mt-3 my-trades" id="cryp_resize">
        <!--mytrades-->
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <h3> <!-- dashboard --></h3>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 mt-2 col-md-offset-2 col-lg-offset-2 col-sm-offset-2 col-xs-offset-0 text-right ">
            <a class="btn create-btn " href='{{url("/profile/$logged_in_user->username")}}' >VIEW PROFILE</a>
        </div>
        <!--active trade table-->
        <h3>Active trades</h3>
        <div class="table-responsive ">
            <!--table-->
            <table class="table table-striped mt-3 mb-4">
                <!--thead-->
                <thead>
                    <tr>
                        <th>Start Date</th>
                        <th>Type</th>
                        <th>Currency</th>
                        <th>Amount</th>
                        <th>Trade partner</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <!--thead-->
                <!--tbody-->
                <tbody>
                    @forelse($trades['activeTrades'] as $key => $value)
                       
                    @php 
                        $username = "";
                        foreach($value->users as $user){
                            if($logged_in_user->id != $user->pivot->user_id)
                            {
                                $username = Helper::getUsername($user->pivot->user_id);
                            }
                            
                        }
                        
                        
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('F d, Y') }}</td>
                        <td><b>{{$value->tradeData->userOfferTrades()->value('type_name')}}</b></td>
                        <td>{{number_format($value->coin_quantity,5)}} {{$value->tradeData->getlocalcoin()->value('short_name')}}</td>
                        <td>{{$value->amount}} {{$value->tradeData->userLocalCurrency()->value('short_name')}}</td>
                        <td><a href='{{url("profile/$username")}}'><b>{{$username}}</b></a></td>
                        <td>{{$value->status}}</td>
                        <td class="text-center">
                            <a href='{{url("trade/$value->uuid")}}'>
                            <button class="btn table-btn" type="submit" name="button"> VIEW </button>
                            </a>
                        </td>
                    </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center"> No Records
                        </td>
                    </tr>
                    @endforelse
                   <!--  <tr>
                        <td>January 27, 2018</td>
                        <td><b>Selling</b></td>
                        <td>0.015 ETH</td>
                        <td>₹1,000.00</td>
                        <td>nadeem0022</td>
                        <td>Waiting for escrow</td>
                        <td class="text-center">
                            <button class="btn table-btn" type="submit" name="button"> VIEW </button>
                        </td>
                    </tr>
                    <tr>
                        <td>January 27, 2018</td>
                        <td><b>Selling</b></td>
                        <td>0.015 ETH</td>
                        <td>₹1,000.00</td>
                        <td>nadeem0022</td>
                        <td>Waiting for escrow</td>
                        <td class="text-center">
                            <button class="btn table-btn" type="submit" name="button"> VIEW </button>
                        </td>
                    </tr>
                    <tr>
                        <td>January 27, 2018</td>
                        <td><b>Selling</b></td>
                        <td>0.015 ETH</td>
                        <td>₹1,000.00</td>
                        <td>nadeem0022</td>
                        <td>Waiting for escrow</td>
                        <td class="text-center">
                            <button class="btn table-btn" type="submit" name="button"> VIEW </button>
                        </td>
                    </tr> -->
                </tbody>
                <!--tbody-->
            </table>
            <!--table-->
        </div>
        <!--active trades table-->
        <!--past trade table-->
        <h3>Past Trades</h3>
        <div class="table-responsive">
            <!--table-->
            <table class="table table-striped mt-3 mb-4">
                <!--thead-->
                <thead>
                    <tr>
                        <th>Start Date</th>
                        <th>Type</th>
                        <th>Currency</th>
                        <th>Amount</th>
                        <th>Trade partner</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <!--thead-->
                <!--tbody-->
                <tbody>
                     @forelse($trades['pastTrades'] as $key => $value)
                       @php 
                        $username = "";
                        foreach($value->users as $user){
                            if($logged_in_user->id != $user->pivot->user_id)
                            {
                                $username = Helper::getUsername($user->pivot->user_id);
                            }
                            
                        }
                        @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('F d, Y') }}</td>
                        <td><b>{{$value->tradeData->userOfferTrades()->value('type_name')}}</b></td>
                        <td>{{number_format($value->coin_quantity,5)}} {{$value->tradeData->getlocalcoin()->value('short_name')}}</td>
                        <td>{{$value->amount}} {{$value->tradeData->userLocalCurrency()->value('short_name')}}</td>
                        <td><a href='{{url("profile/$username")}}'><b>{{$username}}</b></a></td>
                        <td>{{$value->status}}</td>
                        <td class="text-center">
                            <a href='{{url("trade/$value->uuid")}}'>
                            <button class="btn table-btn" type="submit" name="button"> VIEW </button>
                            </a>
                        </td>
                    </tr>
                     @empty
                     <tr> 
                        <td colspan="7" class="text-center"> No Records
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                <!--tbody-->
            </table>
            <!--table-->
        </div>
        <!--past trades table-->
    </div>
    <!--container-->

@endsection