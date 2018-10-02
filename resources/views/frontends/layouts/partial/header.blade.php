    <div class="">
        <nav class="navbar navbar-default navbar-fixed-top top-nav fixed-me">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Logo Starts -->
                    <a class="navbar-brand " href="{{url('/')}}"><img src="{!! asset('frontends/images/footer/logo1.png')!!}"  alt="logo"></a>
                    <!-- #Logo Ends -->
                </div>
                <div id="navbar2" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                       <!--  @auth
                            <li ><a href="{{route('frontend.user.dashboard')}}" class="{{ active_class(Active::checkRoute('frontend.user.dashboard')) }}">{{ __('navs.frontend.dashboard') }}</a></li>
                        @endauth -->
                        @guest
                            <li> <a href="{{url('login')}}"><i class="fa fa-user"></i> Login</a></li>
                            <li> <a href="{{url('register')}}"><i class="fa fa-sign-in"></i> Register</a></li>
                           
                         @else
                         <li class="dropdown">
                             
                              <a class=" dropdown-toggle" type="button" data-toggle="dropdown">{{ $logged_in_user->name }}
                              <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li class="dropdown-header">Activity</li>
                                <li>
                                    <a href="{{ url('my-trades') }}"><strong>My Trades</strong>
                                        <br>
                                        View your active and past trades
                                    </a></li>
                                <li>
                                    <a href="{{ url('my-offers') }}"><strong>My Offers</strong>
                                        <br>
                                        Create, edit or pause your offers
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Account</li>
                                @can('view backend')
                                    <li>    <a href="{{ route('admin.dashboard') }}" >{{ __('navs.frontend.user.administration') }}</a></li>
                                @endcan
                                <li>
                                    <a href="{{ route('frontend.user.account') }}">
                                        <strong>{{ __('navs.frontend.user.account') }}</strong>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('editprofile') }}">
                                        <strong>Edit Account</strong>
                                        <br>
                                        Change your public profile and account settings
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('changepassword') }}">
                                        <strong>Change Password</strong>
                                        <br>
                                        Update your log password
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('changepassword') }}">
                                        <strong>Backup Your Wallet</strong>
                                        <br>
                                        Export your private key for safe-keeping
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.auth.logout') }}">
                                        {{ __('navs.general.logout') }}
                                    </a>
                                </li>
                              </ul>
                            
                         </li>

                         @endguest
                    </ul>
                </div>
                <!--/.nav-collapse-->
            </div>
            <!--/.container-fluid-->
        </nav>
    </div>
    <!--/fixed-top-navbar-->
    <!--scroll navbar-->
    <div class="" id="myapp1">
        <nav class="navbar navbar-default navbar-fixed-top  navbar-me">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand " href="{{url('/')}}"><img src="{!! asset('frontends/images/footer/logo1.png')!!}"  alt="logo" ></a>
                </div>
                <div id="navbar2" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        @auth
                            <notification v-bind:notifications="notifications" v-bind:count="count"></notification>
                            <li ><a href="{{route('frontend.rewards.index')}}" class="{{ active_class(Active::checkRoute('frontend.rewards.index')) }}">Reward <small class="badge">{{Helper::getUserRewardsAmount($logged_in_user->id)}}</small></a></li>
                        @endauth
                        @guest
                            <li> <a href="{{url('login')}}"><i class="fa fa-user"></i> Login</a></li>
                            <li> <a href="{{url('register')}}"><i class="fa fa-sign-in"></i> Register</a></li>
                           
                         @else
                         <li class="dropdown">
                             
                              <a class=" dropdown-toggle" type="button" data-toggle="dropdown">{{ $logged_in_user->name }}
                              <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li class="dropdown-header">Activity</li>
                                <li>
                                    <a href="{{ url('my-trades') }}"><strong>My Trades</strong>
                                        <br>
                                        View your active and past trades
                                    </a></li>
                                <li>
                                    <a href="{{ url('my-offers') }}"><strong>My Offers</strong>
                                        <br>
                                        Create, edit or pause your offers
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Account</li>
                                @can('view backend')
                                    <li>    <a href="{{ route('admin.dashboard') }}" >{{ __('navs.frontend.user.administration') }}</a></li>
                                @endcan
                                <li>
                                    <a href="{{ route('frontend.user.account') }}">
                                        <strong>{{ __('navs.frontend.user.account') }}</strong>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('editprofile') }}">
                                        <strong>Edit Account</strong>
                                        <br>
                                        Change your public profile and account settings
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('changepassword') }}">
                                        <strong>Change Password</strong>
                                        <br>
                                        Update your log password
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('wallet') }}">
                                        <strong>Manage Wallet</strong>
                                        <br>
                                        Export your private key for safe-keeping
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('fund-transfer') }}">
                                        <strong>Fund Transfer</strong>
                                        <br>
                                        Transfer your wallet fund to other.
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('frontend.auth.logout') }}">
                                        {{ __('navs.general.logout') }}
                                    </a>
                                </li>
                              </ul>
                            
                         </li>

                         @endguest
                    </ul>
                </div>
                <!--/.nav-collapse-->
            </div>
            <!--/.container-fluid-->
        </nav>
    </div>