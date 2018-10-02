@extends('frontends.layouts.master')


@section('content')

	<div class="container faq mt-7">
		<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 " id="cryp_resize">
			<h1 class="text-center color-orange">
				{{env('APP_NAME')}}'s Official Blog
			</h1>
			<p class="text-center">
			Check this space for daily updates related to Bitcoin and Altcoin ecosystem.</p>
			<hr>
			<div class="blogs-list">
				<div class="b-links">
					@forelse($blogs as $blog)
					<a href='{{url("blogs/$blog->blog_slug")}}'> 
						<strong>{{$blog->blog_heading}}</strong> 
						<p class="date">{{ $blog->created_at->timezone(get_user_timezone())->format('d M, Y') }}</p>  
						<p class="excerpt">{!! str_limit($blog->blog_text, 100) !!}</p> 
						<p class="read-more">Read more…</p> 
					</a>
					@empty

					<p class="text-center">No Blogs Yet</p>
					@endforelse
				</div>
				<div class="text-center">
					<a href="{{url('/')}}"><button class="btn create-btn">GO TO {{env('APP_NAME')}}</button></a>
				</div>
			</div>
		</div>
	</div>


@endsection