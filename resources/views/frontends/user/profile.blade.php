@extends('frontends.layouts.master')

@section('content')
 <!--container-->

    <div class="container mb-5 profile">
        <div class="row">
            @include('includes.partials.messages')   
        </div>
        <!--profile-->
        <div class="row mb-3">
            <div class="col-md-12 ">
                <h3>{{ $user->username }} profile&emsp;
                    @if(Auth::check() && Auth::id() == $user->id) 
                        <a href="{{url('editprofile')}}"><i class="fa fa-pencil"></i></a>
                    @endif
                </h3>
                <div class="col-md-6">
                    <div class="col-md-2 text-center">
                        <img src="{{ $user->picture }}" class="img-circle img-responsive">
                    </div>
                    <div class="col-md-10">
                        <h4 class="mb-2">Identity key</h4>
                        <p class="mb-2">{{ $user->uuid }}</p>
                        <p class="mb-2">Consider copying this key to ensure it never changes (uncompressed secp256k1).</p>
                        <h4 class="mb-2">History</h4>
                        <div class="table-responsive mb-2">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Member Since</th>
                                        <td class="text-right">{{ __('strings.frontend.general.joined') }} {{ $user->created_at->timezone(get_user_timezone())->format('F jS, Y') }}</td>
                                    </tr>
                                   <!--  <tr>
                                        <th>Trades</th>
                                        <td class="text-right">0</td>
                                    </tr> -->
                                    <tr>
                                        <th>Email verified</th>
                                        <td class="text-right">Yes</td>
                                    </tr>
                                    <tr>
                                        <th>Phone verified</th>
                                        <td class="text-right">{{ $user->phone_confirmed ? "Yes" : "No"}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h4>Bio </h4>
                        <p style="font-size: 12px;">{{ $user->blurb or "user hasn't written a bio yet." }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="mb-2">Trade with User</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <!-- <tr>
                                    <th>Cash (in person)
                                        <br>Indore</th>
                                    <td>24/7
                                        <br>₹1,000 - ₹1,500</td>
                                    <td class="text-center">
                                        <button class="btn table-btn" type="submit" name="button"> VIEW </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Cash (in person)
                                        <br>Indore</th>
                                    <td>24/7
                                        <br>₹1,000 - ₹1,500</td>
                                    <td class="text-center">
                                        <button class="btn table-btn" type="submit" name="button"> VIEW </button>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--profile-->
    </div>
    <!--container-->


@endsection