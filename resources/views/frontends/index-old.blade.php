@extends('frontends.layouts.master')

@section('content')
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div id="particles-js"></div>
                    <div class="carousel-caption">
                        <div class="col-md-12">
                           
                            <div id="gc_countdown">
                                <div id='tiles'></div>
                                <div class="labels">
                                    <li>Days</li>
                                    <li>Hours</li>
                                    <li>Mins</li>
                                    <li>Secs</li>
                                </div>
                            </div>
                            <center>
                                <h3>The market place is launching soon, be the first to experience a complete decentralized smart contract through Crypscrow!</h3></center>
                            <a href="{{url('register')}}" class="btn ">GET STARTED</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/carousel-->
        <!--about-->
        <div>
            <div class="container mt-5 mb-5">
                <div class='content-div'>
                    <center>
                        <h3>A peer-to-peer cryptocurrency exchange</h3></center>
                    <center>
                        <h4>Exchange cryptocurrencies and fiat currency directly with real-life people,powered by end-to-end encryption and well-structured cryptocurrency-powered escrows.</h4></center>
                    <center>
                        <h4>Transact in style and confidence.</h4></center>
                    <div class="col-md-12 mt-4 ">
                        <div class="col-md-6 mb-2">
                            <h4>
                            <i class="fa fa-shopping-bag"></i>
                              Encrypted wallets.
                        </h4>
                            <p>Your wallet is protected and coded in your browser. Your privacy will never be intruded into, you`re in absolute control of your currencies.</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <h4>
                            <i class="fa fa-lock"></i>
                             Maximum character security.
                        </h4>
                            <p>
                                With each character protected by a private key, maximum security is assured. You’d get informed if there’s a change in character.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="col-md-6 mb-2">
                            <h4>
                            <i class="fa fa fa-comments"></i>
                              End to End communication.
                        </h4>
                            <p>
                                Be in absolute control of your personal finances with protected communication, powered by Signal protocol.
                            </p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <h4>
                            <i class="fa fa-asterisk"></i>
                              Decentralized smart contracts.
                        </h4>
                            <p>
                                Contracts are performed using a distributed network system i.e. smart contracts. Trust the technology by using it.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/about-->
        <!--explanation-->
        <div>
            <div class="container mt-5 margin-top ">
                <div class=" mt-4 mb-4">
                    <div class="col-md-6 mb-4 txt-center">
                        <center>
                            <h2 class='vedio-head'>How It Works</h2></center>
                        <iframe width="100%" height="345" src="https://www.youtube-nocookie.com/embed/wSQ_BiFlysA?rel=0"></iframe>
                    </div>
                    <div class="col-md-6 mail">
                        <center>
                            <h3 class=" mb-2 subscrib-head">Subscribe to our mailing list</h3></center>
                        <div style="font-size: 12px"><span>Subscribe to get updates on Crypto Currency</span><span style="float:right"><span class='star'>*</span> indicates required</span>
                        </div>
                        <form>
                            <div class='form-group mb-2'>
                                <label>Email Address <span class='star'>*</span></label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <button class="btn subscribe">subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/explanation-->
        <!--footer-->
        
        <!--/footer-->
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class='fa fa-angle-up'></i></button>
        <style>
        .fixed-me {
            /*background-color:#fff !important;*/
            padding: 0px !important;
            /*margin-bottom: 5px;*/
            position: fixed;
            top: 0;
            z-index: 999;
            width: 100%;
            /*border-bottom: 3px solid #e65100 !important;*/
        }

        canvas {
            display: block;
            vertical-align: bottom;
        }
        </style>
        <!-- javascript libraries -->
        
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
        <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() { scrollFunction() };

        function scrollFunction() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
        </script>
        <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 0) {
                $(".navbar-me").addClass("fixed-me");
                $(".top-nav").css("display", "none");
                $(".fix-nav").css("display", "block");


            } else {
                $(".navbar-me").removeClass("fixed-me");
                $(".top-nav").css("display", "block");
                $(".fix-nav").css("display", "none");
            }
        });

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

        requestAnimationFrame();
        </script>
@endsection