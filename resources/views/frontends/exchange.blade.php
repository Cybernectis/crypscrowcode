@extends('frontends.layouts.master')
@php
$page = Helper::pageByName("exchange");

@endphp 
@section('content')
<!--container-->
    <div class="container mb-7 faq " id="cryp_resize">
        <!--faq-->
    
        {!! $page->section()->where("meta_key", "exchange")->value("meta_value") !!}
    </div>
    <!--container-->
       
@endsection