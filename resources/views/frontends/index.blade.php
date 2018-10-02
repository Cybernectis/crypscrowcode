


@extends('frontends.layouts.master')

@section('content')
 <!--carousel-->
 @push('after-styles')
<style type="text/css">
        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
 @endpush
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div id="particles-js"></div>
                <div class="carousel-caption">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" id="getsliderheight">
                        <div class='content'>
                            <center>
                                <h3>A peer-to-peer cryptocurrency exchange</h3>
                            </center>
                            <center>
                                <h4>Exchange cryptocurrencies and fiat currency directly with real-life people,powered by end-to-end encryption and well-structured cryptocurrency-powered escrows.</h4>
                            </center>
                            <center>
                                <h4>Transact in style and confidence.</h4>
                            </center>
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12  ">
                                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 ">
                                    <h4>
                                        <i class="fa fa-window-restore"></i>
                                        Encrypted wallets.
                                    </h4>
                                    <p>Your wallet is protected and coded in your browser. Your privacy will never be intruded into, you`re in absolute control of your currencies.</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 ">
                                    <h4>
                                        <i class="fa fa-lock"></i>
                                        Maximum character security.
                                    </h4>
                                    <p>
                                        With each character protected by a private key, maximum security is assured. You’d get informed if there’s a change in character.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 ">
                                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 ">
                                    <h4>
                                        <i class="fa fa fa-comments"></i>
                                        End to End communication.
                                    </h4>
                                    <p>
                                        Be in absolute control of your personal finances with protected communication, powered by Signal protocol.
                                    </p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                                    <h4>
                                        <i class="fa fa-file-text-o"></i>
                                        Decentralized smart contracts.
                                    </h4>
                                    <p>
                                        Contracts are performed using a distributed network system i.e. smart contracts. Trust the technology by using it.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('register')}}">  
                            <button class="btn ">GET STARTED</button>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!--/carousel-->
    <!--about-->

        
        <!-- yaha code dalna he wapas -->
        <div class="container">
            <div class="content-div-new">
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 box_shadow">

                    <div class="col-md-9 col-sm-9 col-lg-9 col-xs-12 xs-hidden">
                        <div class="styled">
                            <select name="buysell" id="buysell" onchange="getSearchData()">
                                <option value="0">Buy Or Sell </option>
                                @foreach ($offertype as $key => $value)
                                <option value="{{$value->id}}">{{$value->type_name}}</option>
                                @endforeach 
                            </select>
                        </div>

                        <div class="styled">
                            <select name="coins" id="coins" onchange="getSearchData()">
                                <option value="0">Any Currency</option>
                                @foreach ($localCoin as $key => $value)
                                    <option value="{{$value->id}}" >{{$value->short_name}}</option>
                                @endforeach 
                            </select>
                        </div>

                        &nbsp;<span> using </span>&nbsp;
                        <div class="payment-styled">
                            <select name="paymentmethod" id="paymentmethod" onchange="getSearchData()">
                                <option value="0">Any payment method</option>
                                @foreach ($paymentMethods as $key => $value)
                                <option value="{{$value->id}}" >{{$value->name}}</option>
                                @endforeach 
                            </select>
                        </div>

                        &nbsp;<span> near </span>&nbsp;
                        <div class="world-styled">
                            <select name="country" id="country" onchange="getSearchData()">
                                <option value="0">Worldwide</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
                        <span>Sort by </span>&nbsp;
                        <div class="popularity-styled">
                            <select name="sort_by" id="sort_by" onchange="getSearchData()">
                                <option value="created_at" >Popularity</option>
                                <option value="price">Price</option>
                                <option value="local_coins_id">Coins</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <!-- <coded by tanima ma'm> -->
        <!-- <div class="container mb-2">
                <div class='content-div' style="padding: 1%; width: 86%;box-shadow: 0 1px 2px 0 rgba(0,0,0,.2);">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12">
                            <div class="styled">
                                <select name="buysell" id="buysell" onchange="getSearchData()">
                                    <option value="0">Buy Or Sell </option>
                                    @foreach ($offertype as $key => $value)
                                    <option value="{{$value->id}}">{{$value->type_name}}</option>
                                    @endforeach 
                                </select>

                            </div>
                            <div class="styled">
                                <select name="coins" id="coins" onchange="getSearchData()">
                                    <option value="0">Any Currency</option>
                                    @foreach ($localCoin as $key => $value)
                                        <option value="{{$value->id}}" >{{$value->short_name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            &nbsp;<span> using </span>&nbsp;
                            <div class="payment-styled">
                                <select name="paymentmethod" id="paymentmethod" onchange="getSearchData()">
                                    <option value="0">Any payment method</option>
                                    @foreach ($paymentMethods as $key => $value)
                                    <option value="{{$value->id}}" >{{$value->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            &nbsp;<span> near </span>&nbsp;
                            <div class="world-styled" >
                                <select name="country" id="country" onchange="getSearchData()">
                                    <option value="0">Worldwide</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-4 col-sm-4 col-lg-4 col-xs-12 text-right">
                            <span>Sort by </span>&nbsp;
                            <div class="popularity-styled">
                                <select name="sort_by" id="sort_by" onchange="getSearchData()">
                                    <option value="created_at" >Popularity</option>
                                    <option value="price">Price</option>
                                    <option value="local_coins_id">Coins</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>  
        </div> -->
        <br>
        <br>
        <br>
        <br>
        <!--/about-->
        <!--explanation-->
        <div>
            <div class="ajax-loading text-center">
                <img src="{{ asset('images/loading.gif') }}" />
                <!-- <button class="btn btn-default">View More Records</button> -->
            </div>
            
            <div class="container responsive-margin " id="returnHtml" style="min-height: 250px;">
               
            </div>
        </div>
        <!--/explanation-->
    
    <!--/about-->
    <div>
       
    </div>
    <!--explanation-->
    <div>
        <div class="container">
            <div class=" mt-4 mb-4">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 mb-4 txt-center">
                    <center>
                        <h2 class='vedio-head'>How It Works</h2></center>
                    <iframe width="100%" height="345" src="https://www.youtube-nocookie.com/embed/wSQ_BiFlysA?rel=0"></iframe>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 mail">
                    <center>
                        <h3 class=" mb-2 subscrib-head">Subscribe to our mailing list</h3>
                    </center>
                    <div style="font-size: 12px"><span>Subscribe to get updates on Crypto Currency</span><span style="float:right"><span class='star'>*</span> indicates required</span>
                    </div>
                    <form action="https://crypscrow.us17.list-manage.com/subscribe/post?u=f354c578c32f3fb994af49582&amp;id=4a8f4f72ce"  method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div class='form-group mb-2'>
                            <label>Email Address <span class='star'>*</span></label>
                            <input type="email" value="" name="EMAIL" class="form-control" id="mce-EMAIL" placeholder="email address" requiredclass="form-control">
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_f354c578c32f3fb994af49582_4a8f4f72ce" tabindex="-1" value=""></div>
                        </div>
                        <button type="submit" class="btn subscribe" id="mc-embedded-subscribe" >subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!--/explanation-->
  <script src="{!! asset('frontends/js/particles.min.js')!!}"></script>
    @push("after-scripts")
 
 

     <script type="text/javascript">
            $(document).ready(function($) {
                
                if(typeof geoplugin_countryName == 'function' || typeof geoplugin_city == 'function' || typeof geoplugin_region == 'function'  || typeof geoplugin_countryName == 'function' )
                {
                    $("#country").append('<option value="'+geoplugin_countryName()+'" selected>'+geoplugin_city()+', '+geoplugin_region()+', '+geoplugin_countryName()+'</option>');
                }
                
                getSearchData();
            });
            function getSearchData()
            {
                
                $('.ajax-loading').show();
                var country         = $("select#country option").filter(":selected").val();
                
                var paymentmethod   = $("select#paymentmethod option").filter(":selected").val();
                var buysell         = $("select#buysell option").filter(":selected").val();
                var coins           = $("select#coins option").filter(":selected").val();
                var sort_by         = $("select#sort_by option").filter(":selected").val();
                var data =  {
                                country : country,
                                paymentmethod:paymentmethod,
                                buysell:buysell,
                                coins:coins,
                                sort_by:sort_by
                            };
                var url = host + "/search";
                axios.post(url, data)
                    .then((response) => {
                      $("#returnHtml").empty();
                       $("#returnHtml").html(response.data);
                       $('.ajax-loading').hide();
                    }); 
            }
      </script>
    <script>
    //     // Set the date we're counting down to
    // var countDownDate = new Date("Apr 15, 2018 18:37:25").getTime();

    // // Update the count down every 1 second
    // var x = setInterval(function() {

    //     // Get todays date and time
    //     var now = new Date().getTime();

    //     // Find the distance between now an the count down date
    //     var distance = countDownDate - now;

    //     // Time calculations for days, hours, minutes and seconds
    //     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    //     // Display the result in the element with id="demo"
    //     if (document.getElementById("tiles") !== null || (typeof document.getElementById("tiles") === 'undefined')) 
    //     {

    //         document.getElementById("tiles").innerHTML = "<span>" + days + "</span><span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>";
    //     }


    //     // If the count down is finished, write some text 
    //     if (distance < 0) {
    //         clearInterval(x);
    //         document.getElementById("tiles").innerHTML = "";
    //     }
    // }, 1000);




    function pad(n) {
        return (n < 10 ? '0' : '') + n;
    }
    particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": 80,
                "density": {
                    "enable": true,
                    //        "value_area": 800
                }
            },
            "color": {
                "value": "#ffffff"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                },
                "polygon": {
                    "nb_sides": 5
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 0.5,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 5,
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": 2,
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 40,
                    "size_min": 3,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#ffffff",
                "opacity": 0.4,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 2,
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": true,
                    "mode": "grab"
                },
                "onclick": {
                    "enable": true,
                    "mode": "push"
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 150,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                },
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 4
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });

    
    </script>
    @endpush
@endsection