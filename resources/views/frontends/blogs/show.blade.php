@extends('frontends.layouts.master')

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b9f3b4a400e3562"></script>

@section('content')

	<div class="container faq mt-7">
		<div class="col-md-6 col-lg-6 col-xs-12 col-sm-6 col-md-offset-3 col-lg-offset-3 col-sm-offset-3 col-xs-offset-0 " id="cryp_resize">
			<h1 class="text-center color-orange">
				{{env('APP_NAME')}} official blog
			</h1>
			<p class="text-center">
			The official blog of {{env('APP_NAME')}}. Follow us for updates on security and the crypto-financial ecosystem.</p>
			<hr>
			<h2 class="text-center text-capitalize color-orange">{{!empty($blog->blog_heading) ? $blog->blog_heading : "" }}</h2>
			<small>Published {{ $blog->created_at->timezone(get_user_timezone())->format('d M, Y') }}</small>
			<br>
			{!! $blog->blog_text !!}
			<br>
			<br>
			<div class="text-center">
				<a href="{{url('/')}}"><button class="btn create-btn">GO TO {{env('APP_NAME')}}</button></a>
			</div>
		</div>
	</div>

@endsection