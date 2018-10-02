@extends('frontends.layouts.master')
@php
$page = Helper::pageByName("faq");

@endphp 
@section('content')
<!--container-->
    <div class="container mb-7 faq " id="cryp_resize">
        <!--faq-->
        <div class="row mb-3">
            <div class="col-md-11 col-md-offset-1">
                <h3 class=" mb-3 mt-9 color-orange text-center">Frequently Asked Questions</h3>
            </div>
            
            
        </div>
        {!! $page->section()->where("meta_key", "faq")->value("meta_value") !!}
    </div>
    <!--container-->
       
@endsection