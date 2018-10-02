@extends('frontends.layouts.master')

@section('content')
<div class="container  mb-9 mt-3 my-trades">
        <div class="row">
            @include('includes.partials.messages')   
        </div>
        <!--mytrades-->
        <div class="col-md-6">
            <h3>{{ $logged_in_user->name }} dashboard</h3>
        </div>
        <div class="col-md-4 mt-2 col-md-offset-2 text-right">
            <a class="btn create-btn" href="{{ route('frontend.user.account') }}"  name="button">VIEW PROFILE</a>
        </div>
        <!--active trade table-->
        <h3>Active trades</h3>
        <div class="table-responsive ">
            <!--table-->
            <table class="table table-striped mt-3 mb-4">
                <!--thead-->
                <thead>
                    <tr>
                        <th>Date opened</th>
                        <th>Type</th>
                        <th>Ether</th>
                        <th>Amount</th>
                        <th>Trade partner</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <!--thead-->
                <!--tbody-->
                <tbody>
                    <tr class="text-center">
                        <td colspan="7">No Trades Yet</td>
                    </tr>
                    <!-- <tr>
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
        <h3>past trades</h3>
        <div class="table-responsive">
            <!--table-->
            <table class="table table-striped mt-3">
                <!--thead-->
                <thead>
                    <tr>
                        <th>Date opened</th>
                        <th>Type</th>
                        <th>Ether</th>
                        <th>Amount</th>
                        <th>Trade partner</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <!--thead-->
                <!--tbody-->
                <tbody>
                    <tr class="text-center">
                        <td colspan="7">No Trades Yet</td>
                    </tr>
                    <!-- <tr>
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
        <!--past trades table-->
    </div>



@endsection