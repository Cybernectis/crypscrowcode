@extends('frontends.layouts.master')

@section('content')
<style type="text/css">
        /* ---- reset ---- */ 
        body{ margin:0; font:normal 75% Arial, Helvetica, sans-serif; } canvas{ display: block; vertical-align: bottom; } 
        /* ---- particles.js container ---- */ 
        #particles-js{ position:relative; width: 100%; height: 100%; background-color: #17021b;  background-repeat: no-repeat; background-size: 70%; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: relative; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }

            .hero-text {
                text-align: center;
                position: absolute;
                top: 30%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: white;
            }
    </style>
<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
#mc_embed_signup {
    background: #fff;
    clear: left;
    font: 14px Helvetica, Arial, sans-serif;
    /*width:300px;*/
}



/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
     We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<style type="text/css">
#gc_countdown {
    width: 465px;
    height: 156px;
    text-align: center;
    background: #827da9;
    /*background-image: -webkit-linear-gradient(top, #222, #333, #333, #222); 
  background-image:    -moz-linear-gradient(top, #222, #333, #333, #222);
  background-image:     -ms-linear-gradient(top, #222, #333, #333, #222);
  background-image:      -o-linear-gradient(top, #222, #333, #333, #222);*/
    border: 1px solid #111;
    border-radius: 5px;
    box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.6);
    margin: auto;
    padding: 24px 0;
    position: relative;
    /* top: 0;*/
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1;
}

#gc_countdown:before {
    content: "";
    width: 8px;
    height: 65px;
    background: #444;
    background-image: -webkit-linear-gradient(top, #555, #444, #444, #555);
    background-image: -moz-linear-gradient(top, #555, #444, #444, #555);
    background-image: -ms-linear-gradient(top, #555, #444, #444, #555);
    background-image: -o-linear-gradient(top, #555, #444, #444, #555);
    border: 1px solid #111;
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
    display: block;
    position: absolute;
    top: 48px;
    left: -10px;
    z-index: 1;
}

#gc_countdown:after {
    content: "";
    width: 8px;
    height: 65px;
    background: #444;
    background-image: -webkit-linear-gradient(top, #555, #444, #444, #555);
    background-image: -moz-linear-gradient(top, #555, #444, #444, #555);
    background-image: -ms-linear-gradient(top, #555, #444, #444, #555);
    background-image: -o-linear-gradient(top, #555, #444, #444, #555);
    border: 1px solid #111;
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
    display: block;
    position: absolute;
    top: 48px;
    right: -10px;
    z-index: 1;
}

#gc_countdown #tiles {
    position: relative;
    z-index: 1;
}

#gc_countdown #tiles>span {
    width: 92px;
    max-width: 92px;
    font: bold 48px 'Droid Sans', Arial, sans-serif;
    text-align: center;
    color: #111;
    background-color: #ddd;
    background-image: -webkit-linear-gradient(top, #bbb, #eee);
    background-image: -moz-linear-gradient(top, #bbb, #eee);
    background-image: -ms-linear-gradient(top, #bbb, #eee);
    background-image: -o-linear-gradient(top, #bbb, #eee);
    border-top: 1px solid #fff;
    border-radius: 3px;
    box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.7);
    margin: 0 7px;
    padding: 18px 0;
    display: inline-block;
    position: relative;
}

#gc_countdown #tiles>span:before {
    content: "";
    width: 100%;
    height: 13px;
    background: #111;
    display: block;
    padding: 0 3px;
    position: absolute;
    top: 41%;
    left: -3px;
    z-index: -1;
}

#gc_countdown #tiles>span:after {
    content: "";
    width: 100%;
    height: 1px;
    background: #eee;
    border-top: 1px solid #333;
    display: block;
    position: absolute;
    top: 48%;
    left: 0;
    z-index: 1;
}

#gc_countdown .labels {
    width: 100%;
    height: 25px;
    text-align: center;
    position: absolute;
    bottom: 8px;
    z-index: 1;
}

#gc_countdown .labels li {
    width: 102px;
    font: bold 15px 'Droid Sans', Arial, sans-serif;
    color: #f5f5f5;
    text-shadow: 1px 1px 0px #000;
    text-align: center;
    text-transform: uppercase;
    display: inline-block;
    z-index: 1;
}

@media (max-width: 767px) {
#gc_countdown {
    width: 100%;
     padding: 24px 0;
}
  #gc_countdown #tiles>span {
    width: 50px;
    max-width: 50px;
    font: bold 20px 'Droid Sans', Arial, sans-serif;
}
#gc_countdown .labels {
    width: 100%;
    height: 15px;
    }
#gc_countdown .labels li {
    width: 63px;
    font: bold 10px 'Droid Sans', Arial, sans-serif;
    color: #f5f5f5;
    text-shadow: 1px 1px 0px #000;
    text-align: center;
    text-transform: uppercase;
    display: inline-block;
    z-index: 1;
    }
}
</style>
<div id="particles-js" style="height: 350px"></div>
<div class="col-md-2"></div>
<div class="hero-text col-md-8 col-xs-12">
    
    <script type="text/javascript">
    // Set the date we're counting down to
    var countDownDate = new Date("Mar 15, 2018 15:37:25").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("tiles").innerHTML = "<span>" + days + "</span><span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>";
        // If the count down is finished, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("tiles").innerHTML = "";
        }
    }, 1000);




    function pad(n) {
        return (n < 10 ? '0' : '') + n;
    }
    </script>
    <!--  <h3>
    <strong>
      A peer-to-peer cryptocurrency exchange
    </strong>
  </h3>
  <br/>
  <h4>
    Exchange cryptocurrencies and fiat currency directly with real-life people,powered by end-to-end encryption and well-structured cryptocurrency-powered escrows.
  </h4>
  <br/>
  <h5>
    Transact in style and confidence.
  </h5>
  <br/> -->
    


    <div class="clearfix"></div><br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="col-md-12 col-xs-12">
        <div id="gc_countdown">
            <div id='tiles'></div>
            <div class="labels">
                <li>Days</li>
                <li>Hours</li>
                <li>Mins</li>
                <li>Secs</li>
            </div>
        </div>
        <div ></div>
    </div>
    <div class="col-md-12 col-xs-12">
        <br/>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <a href="{{url('register')}}" class="thm-btn">Get Started</a>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="col-md-12 col-xs-12">
        <h3>
          <strong>The market place is launching soon, be the first to experience a complete decentralized smart contract through Crypscrow!</strong>
        </h3>
    </div>
    

</div>
<div class="col-md-2"></div>
<section class="prices">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 filter ">
            <form class="form-horizontal hidden">
                <div class="form-group">
                    <!-- <label for="inputEmail3" class="col-md-2 control-label">Email</label> -->
                    <div class="col-sm-2">
                        <select class="form-control">
                            <option>Buy or Sell</option>
                            <option>Buy</option>
                            <option>Sell</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control">
                            <option>Crypto currency</option>
                            <option>BTC</option>
                            <option>LTC</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" id="sel1">
                            <option>Payment method</option>
                            <option>Cash (in person)</option>
                            <option>Bank transfer</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" id="sel1">
                            <option>World wide</option>
                            <option>India</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" id="sel1">
                            <option>Sort by</option>
                            <option>Price</option>
                            <option>Popularity</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-md-12">
                <h3>
              <strong>
                A peer-to-peer cryptocurrency exchange
              </strong>
            </h3>
                <br/>
                <h4>
              Exchange cryptocurrencies and fiat currency directly with real-life people,powered by end-to-end encryption and well-structured cryptocurrency-powered escrows.
            </h4>
                <br/>
                <h4>
              Transact in style and confidence.
            </h4>
                <br/>
                <br>
            </div>
            <br/>
            <br>
            <div class="col-md-6" style="text-align: left;">
                <h4>
              <strong>
              <i class="fa fa-shopping-bag"></i>  Encrypted wallets.
              </strong>
            </h4>
                <br>
                <p>
                    Your wallet is protected and coded in your browser. Your privacy will never be intruded into, you`re in absolute control of your currencies.
                </p>
                <br>
                <h4>
              <strong>
              <i class="fa fa-comments"></i>  End to End communication.
              </strong>
            </h4>
                <br>
                <p>
                    Be in absolute control of your personal finances with protected communication, powered by Signal protocol.
                </p>
                <br>
                <br>
                <br>
                <!-- <p>
              Get the best offers for you:
            </p>
            <p>
              Currency
            </p>
            <p>
              Trade
            </p>
            <p>
              Any payment form
            </p>
            <p>
              International
            </p>
            <p>
              Acceptability
            </p> -->
            </div>
            <div class="col-md-6" style="text-align: left;">
                <h4>
	              <strong>
	              <i class="fa fa-lock"></i>  Maximum character security.
	              </strong>
	            </h4>
                <br>
                <p>
                    With each character protected by a private key, maximum security is assured. You’d get informed if there’s a change in character.
                </p>
                <br>
                <h4>
	              <strong>
	              <i class="fa fa-asterisk"></i>  Decentralized smart contracts.
	              </strong>
            	</h4>
                <br>
                <p>
                    Contracts are performed using a distributed network system i.e. smart contracts. Trust the technology by using it.
                </p>
                <br>
                <br>
                <br>
            </div>
            <div class="clear-fix"></div>
            <br>
            <br>
            <div class="col-md-6">
                <h2><strong>How It Works</strong></h2>
                <br>
                <iframe width="100%" height="315" src="https://www.youtube-nocookie.com/embed/wSQ_BiFlysA?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
            <div class="col-md-6">
               
                    <div id="mc_embed_signup">
                        <form action="https://crypscrow.us17.list-manage.com/subscribe/post?u=f354c578c32f3fb994af49582&amp;id=4a8f4f72ce" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll">
                                <!-- <h2 class="text-center">Subscribe to get updates on Crypto Currency </h2> -->
                                <h2 class="text-center">Subscribe to our mailing list</h2>
                                 <div style="padding-top: 10%; padding-bottom: 5%">
                                <div class="indicates-required pull-left">Subscribe to get updates on Crypto Currency</div>
                                <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                                <div class="mc-field-group">
                                    <label for="mce-EMAIL">Email Address <span class="asterisk">*</span>
                                    </label>
                                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                                </div>
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                    <input type="text" name="b_f354c578c32f3fb994af49582_4a8f4f72ce" tabindex="-1" value="">
                                </div>
                                <div class="clear">
                                    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="thm-btn style-two">
                                </div>
                                </div>
                            </div>
                        </form>
                    
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection