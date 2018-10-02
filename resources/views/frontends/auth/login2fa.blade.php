@extends('frontends.layouts.master')

@section('content')
 <!--container-->
    <div class="container mt-7 mb-7 login " id="cryp_resize">
        
        <!--login-->
        <div class="row mb-3">
            <div class="col-md-6 mb-3 col-md-offset-3">
                <h2 class=" mt-10 mb-3">Log in OTP</h2>
                <div class="row">
                    <br>
                    @include('includes.partials.messages')   
                </div>
                <!--login form-->
                {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                    <div class="form-group">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="hidden" name="password" value="{{$password}}">
                    </div>
                    <div class="form-group mb-5">
                        <input type="number" name="secret" class="form-control">
                    </div>
                    <button class="btn subscribe" type="submit" name="button">
                        {{ __('labels.frontend.auth.login_button') }}
                    </button>
                    
                {{ html()->form()->close() }}
                <!--login form-->
            </div>
        </div>
        <!--login-->
    </div>
    <!--container-->
  
@endsection