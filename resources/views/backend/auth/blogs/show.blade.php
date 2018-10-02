@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.blogs.management') . ' | ' . __('labels.backend.access.blogs.show'))

@section('content')

    <div class="card">
        <div class="card-body text-center">
            <h1>{{$blog->blog_heading}}</h1>
            <h3>{{$blog->blog_sub_heading}}</h3>
            <hr>
            @if($blog->blog_image)
                <img src='{{asset("$blog->blog_image")}}' class="img-fluid">

            @endif
            {!! $blog->blog_text !!}
        </div><!--card-body-->

        
    </div><!--card-->
{{ html()->closeModelForm() }}

@endsection
