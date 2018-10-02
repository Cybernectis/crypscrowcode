<!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="UTF-8">
	<title>CrypScrow</title> 
	
	<!-- mobile responsive meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="{!!asset('frontends/css/style.css')!!}">
	<link rel="stylesheet" href="{!!asset('frontends/css/responsive.css')!!}">
	<link rel="stylesheet" href="{!!asset('frontends/fonts/flaticon.css')!!}" />
	<!--favicon-->
	<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="{!!asset('frontends/images/favicon/favicon-32x32.png')!!}" sizes="32x32">
	<link rel="icon" type="image/png" href="{!!asset('frontends/images/favicon/favicon-16x16.png')!!}" sizes="16x16">
	 @stack('after-scripts')
</head>

<body>
	<div class="boxed_wrapper">
		

		@include('frontends.layouts.partial.header')
          <div class="container">
        @include('includes.partials.messages') 
    </div>  
    	@yield('content')
		
		@include('frontends.layouts.partial.footer')

		
		
	<!-- Scroll Top Button -->
	<button class="scroll-top tran3s color2_bg">
		<span class="fa fa-angle-up"></span>
	</button>
	@include('frontends.layouts.partial.bottomfooter')
	<!-- pre loader  -->
	<div class="preloader"></div>

		
	</div>
    

	
</body>

</html>



