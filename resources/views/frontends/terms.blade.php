@extends('frontends.layouts.master')
@php
$page = Helper::pageByName("terms");

@endphp
@section('content')
<!--container-->
    <div class="container mt-7 mb-7 Terms">
        <!--trems-->
        <div class="row mb-3">
            {!! $page->section()->where("meta_key", "terms")->value("meta_value") !!}
            
        </div>
        <!--trems-->
    </div>
    <!--container-->
 


@endsection