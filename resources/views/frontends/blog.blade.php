@extends('frontends.layouts.master')
@php
$page = Helper::pageByName("blog");
$image = "uploads/pages/".$page->section()->where("meta_key", "blog_image")->value("meta_value")
@endphp 

@push('after-styles')
<link rel="stylesheet" type="text/css" href="{{asset('frontends/css/clean-blog.css')}}">
@endpush
@section('content')
<!--container-->
    <!-- <div class="container mt-7 mb-7 faq mt-3"> -->
        <!--faq-->
      <!--   <div class="row mb-3"> -->

            <header class="intro-header" style="background-image: url('{{asset($image)}}')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                            <div class="page-heading">
                                <h1>{{$page->section()->where("meta_key", "blog_heading")->value("meta_value")}}</h1>
                                <hr class="small">
                                <span class="subheading">{{$page->section()->where("meta_key", "blog_subheading")->value("meta_value")}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                {!! $page->section()->where("meta_key", "blog_text")->value("meta_value")!!}
                
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <!-- <footer> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href='{{$page->section()->where("meta_key", "blog_twitter")->value("meta_value")}}'>
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href='{{$page->section()->where("meta_key", "blog_fb")->value("meta_value")}}'>
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href='{{$page->section()->where("meta_key", "blog_github")->value("meta_value")}}'>
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                   
                </div>
            </div>
        </div>
    <!-- </footer> -->
       <!--  </div>
    </div> -->
    <!--container-->
       
@endsection