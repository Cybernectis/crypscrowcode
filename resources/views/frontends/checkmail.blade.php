@extends('frontends.layouts.master')


@section('content')
<!--container-->
    <div class="container mt-7 mb-7 faq mt-3" id="cryp_resize">
       
        <div class="row mt-7 text-center">
            <h2 class="text-center">Please check your inbox we just sent you email to login to {{env('APP_NAME')}}</h2>

            <a href="{{url('/')}}">
                <button class="btn  btn-primary" >Back</button>
            </a>  
        </div>
    </div>
    <!--container-->
       
@endsection