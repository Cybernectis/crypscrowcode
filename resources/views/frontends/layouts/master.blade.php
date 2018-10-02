<!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <title>CrypScrow: New Generation Peer to Peer Exchange</title>
    <meta name="Description" content="Exchange cryptocurrencies and fiat currency directly with real-life people,powered by end-to-end 
    encryption and well-structured cryptocurrency-powered escrows.">
    <meta name="Keywords" content="crypto-currency, altcoins, bitcoin, ethereum, dodgecoin, litecoin, crypto-exchange, dash coin, etc">  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">
    <meta name="authstatus" content="{{ Auth::check()}}">
    <meta name="bitstamp_access_key" content="{{ env('BITSTAMP_ACCESS_KEY')}}">
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{!! asset('frontends/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontends/css/style.css') !!}">
    <!--favicon-->
    <link rel="apple-touch-icon" sizes="180x180" href="{!!asset('images/favicon/apple-touch-icon.png')!!}">
    <!-- <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="{!! asset('frontends/images/favicon/favicon-32x32.png')!!}" sizes="32x32">
    <link rel="icon" type="image/png" href="{!! asset('frontends/images/favicon/favicon-16x16.png')!!}" sizes="16x16">
    <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117547527-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-117547527-1');
    </script>
    @stack('after-styles')

</head>

<body style="height: 100%" > 

        
    
    @include('frontends.layouts.partial.header')
  
    @auth
        @if(!(request()->is('/') || request()->is('blog') || request()->is('terms') || request()->is('faq') || request()->is('contact')))
        <div class="container mt-12">
            <div class="alert  text-center alert-grey">
                Invite your friends and earn <b>{{Helper::getAdminAffiliatesRate()->affiliate_percentage}} {{Helper::getAdminAffiliatesRate()->amount_symbol}}</b> as commission for each user you refer to us.
                <br>
                Note: You will get {{Helper::getAdminAffiliatesRate()->affiliate_percentage}} {{Helper::getAdminAffiliatesRate()->amount_symbol}} once per user post completion of their first transaction.
                <br>
               
                You should use the link <strong><a href='{{url("register")."?refer_by=$logged_in_user->uuid"}}' class="alert-link" id="linkToCopy">{{url("register")."?refer_by=$logged_in_user->uuid"}}</a></strong> to invite.<br>
                <div id="copyLink" style="display: none">{{url("register")."?refer_by=$logged_in_user->uuid"}}</div>
                <button class="btn btn-grey" onclick="CopyToClipboard('linkToCopy')">Copy Link</button>
            </div>
        </div>
        @endif 
    @endauth
    @yield('content')
       
    @include('frontends.layouts.partial.footer')

  
    @include('frontends.layouts.partial.bottomfooter')
    <script type="text/javascript">
        function resize()
        {
            var heights = window.innerHeight;
            if (document.getElementById("cryp_resize") !== null || (typeof document.getElementById("cryp_resize") === 'undefined')) 
            {

                document.getElementById("cryp_resize").style.minHeight = heights + "px";
            }

            var testheight = $('.carousel-caption > .col-md-12').height();
            // testheight  = parseInt(testheight) + 30;
            console.log(testheight);
            $(".content-div ").css('top',testheight + "px !important");

        }
        resize();
        window.onresize = function() {
            resize();
        };

        function CopyToClipboard(containerid) {
            if (document.selection) { 
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("copy"); 
                swal("Success!!", "Link Copied", "success");

            } else if (window.getSelection) {
                var range = document.createRange();
                document.getElementById(containerid).style.display = 'block';
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("copy");
                document.getElementById(containerid).style.display = 'none';
                swal("Success!!", "Link Copied", "success");
            }
        }
           
    </script>
     {!! script(('js/frontend.js')) !!}
    @stack('after-scripts')


</body>

</html>



