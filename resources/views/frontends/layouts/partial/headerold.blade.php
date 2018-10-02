<div class="mainmenu-area stricky">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="main-logo">
                    <!-- <a href="index-2.html"><img src="images/logo/logo.png" alt=""></a> -->
                    <a href="{{url('/')}}"><img src="{!! asset('frontends/images/footer/logo1.png')!!}" alt=""></a>
                </div>
            </div>
            <div class="">
                
                <aside class="col-md-6 col-sm-6 ">
                    <ul class="crypto-user-section">
                        @auth
                            <li ><a href="{{route('frontend.user.dashboard')}}" class="{{ active_class(Active::checkRoute('frontend.user.dashboard')) }}">{{ __('navs.frontend.dashboard') }}</a></li>
                        @endauth
                        @guest
                            <li> <a href="{{url('login')}}"><i class="fa fa-user"></i> Login</a></li>
                            <li> <a href="{{url('register')}}"><i class="fa fa-sign-in"></i> Register</a></li>
                           
                         @else
                         <li class="dropdown">
                             
                              <a class=" dropdown-toggle" type="button" data-toggle="dropdown">{{ $logged_in_user->name }}
                              <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                @can('view backend')
                                    <li>    <a href="{{ route('admin.dashboard') }}" >{{ __('navs.frontend.user.administration') }}</a></li>
                                @endcan
                                <li><a href="{{ route('frontend.user.account') }}">{{ __('navs.frontend.user.account') }}</a></li>
                                <li><a href="{{ url('editprofile') }}">Edit Profile</a></li>
                                <li><a href="{{ url('changepassword') }}">Change Password</a></li>
                                <li><a href="{{ route('frontend.auth.logout') }}">{{ __('navs.general.logout') }}</a></li>
                              </ul>
                            
                         </li>
                         
                        @endguest
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</div>
