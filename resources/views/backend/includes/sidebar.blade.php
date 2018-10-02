<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                {{ __('menus.backend.sidebar.general') }}
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="{{ route('admin.dashboard') }}"><i class="icon-speedometer"></i> {{ __('menus.backend.sidebar.dashboard') }}</a>
            </li>

            <li class="nav-title">
                {{ __('menus.backend.sidebar.system') }}
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="icon-user"></i> {{ __('menus.backend.access.title') }}

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                                {{ __('labels.backend.access.users.management') }}

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">
                                {{ __('labels.backend.access.roles.management') }}
                            </a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/wallet*')) }}" href="{{ route('admin.auth.wallet.index') }}">
                                {{ __('labels.backend.access.wallet.management') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*')) }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="icon-screen-tablet"></i> {{ __('labels.backend.access.pages.management') }}
                    </a>

                    <ul class="nav-dropdown-items">
                        @foreach(Helper::pages() as $page)
                              <li class="nav-item">
                                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/pages*')) }}" href='{{url("admin/auth/pages/$page->slug")}}'>
                                        {{$page->name}}
                                    </a>
                            </li>
                       @endforeach
                        
                    </ul>
                </li>
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*')) }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="icon-chart"></i> {{ __('labels.backend.access.stats.management') }}
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/all")}}'>
                                All Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/visits")}}'>
                                Page Visits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/login-attempts")}}'>
                                Login Attempts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/users")}}'>
                                Users
                            </a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/unique")}}'>
                                Unique Visitors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/countries")}}'>
                                Country
                            </a>
                        </li>
                    </ul>
                </li> 
                <!-- <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/settings*')) }}" href="{{ route('admin.auth.settings.index') }}">
                        {{ __('labels.backend.access.settings.management') }}
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/funds*')) }}" href="{{ route('admin.auth.funds.index') }}">
                        <i class="icon-wallet"></i>
                        {{ __('labels.backend.access.funds.management') }}
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/rewards*')) }}" href="{{ route('admin.auth.rewards.index') }}">
                        <i class="icon-wallet"></i>
                        {{ __('labels.backend.access.rewards.management') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/affiliates*')) }}" href="{{ route('admin.auth.affiliates.index') }}">
                        <i class="icon-star"></i>
                        {{ __('labels.backend.access.affiliates.management') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/localcoins*')) }}" href="{{ route('admin.auth.localcoins.index') }}">
                        <i class="icon-disc"></i>
                        {{ __('labels.backend.access.localcoins.management') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/blogs*')) }}" href="{{ route('admin.auth.blogs.index') }}">
                        <i class="icon-wallet"></i>
                        {{ __('labels.backend.access.blogs.management') }}
                    </a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/payments*')) }}" href="{{ route('admin.auth.payments.index') }}">
                        <i class="icon-briefcase"></i>
                        {{ __('labels.backend.access.payments.management') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/exchangerate*')) }}" href="{{ route('admin.auth.exchangerate.index') }}">
                        <i class="icon-refresh"></i>

                        {{ __('labels.backend.access.exchange.management') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/dispute*')) }}" href="{{ route('admin.auth.dispute.index') }}">
                        <i class="icon-action-redo"></i>

                        {{ __('labels.backend.access.dispute.management') }}
                    </a>
                </li>
                
            @endif
            @if($logged_in_user->isExecutive())
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                        {{ __('labels.backend.access.users.management') }}

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>
                </li>
                 <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*')) }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="icon-chart"></i> {{ __('labels.backend.access.stats.management') }}
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/all")}}'>
                                All Requests
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/visits")}}'>
                                Page Visits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/login-attempts")}}'>
                                Login Attempts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/users")}}'>
                                Users
                            </a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/unique")}}'>
                                Unique Visitors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/stats*')) }}" href='{{url("admin/auth/stats/countries")}}'>
                                Country
                            </a>
                        </li>
                    </ul>
                </li> 
<li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/blogs*')) }}" href="{{ route('admin.auth.blogs.index') }}">
                        <i class="icon-wallet"></i>
                        {{ __('labels.backend.access.blogs.management') }}
                    </a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/dispute*')) }}" href="{{ route('admin.auth.dispute.index') }}">
                        <i class="icon-action-redo"></i>

                        {{ __('labels.backend.access.dispute.management') }}
                    </a>
                </li>
            @endif
            <!-- <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="icon-list"></i> {{ __('menus.backend.log-viewer.main') }}
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}" href="{{ route('log-viewer::dashboard') }}">
                            {{ __('menus.backend.log-viewer.dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}" href="{{ route('log-viewer::logs.list') }}">
                            {{ __('menus.backend.log-viewer.logs') }}
                        </a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </nav>
</div><!--sidebar-->