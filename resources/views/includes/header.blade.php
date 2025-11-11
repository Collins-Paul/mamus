<div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                   <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="user-toggle">
                                                <div class="user-avatar">
                                                    <div style="
                                                        width: 35px !important;
                                                        height: 35px !important;
                                                        border-radius: 100px !important;
                                                        background-position: center !important;
                                                        background-size: contain !important;
                                                        background: url({{ asset('traders-photo/'.Auth::user()->photo) }});
                                                        "></div>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">My Account</div>
                                                    <div class="user-name dropdown-indicator">{{ Auth::user()->first_name ." ". Auth::user()->last_name }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1" style="">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <a href="{{ Auth::user()->who == 2 ? route('admin.settings') : route('user.view.user.profile', ['id' => encrypt(Auth::user()->id)]) }}">
                                                            <div style="
                                                            width: 50px !important;
                                                            height: 50px !important;
                                                            border-radius: 100px !important;
                                                            background-position: center !important;
                                                            background-size: contain !important;
                                                            background: url({{ asset('traders-photo/'.Auth::user()->photo) }});
                                                            "></div>
                                                        </a>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ Auth::user()->first_name ." ". Auth::user()->last_name }}</span>
                                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                 <ul class="link-list">
                                                    @if (Auth::user()->who == 1)
                                                    <li><a href="{{ route('user.view.user.profile', ['id' => encrypt(Auth::user()->id)]) }}"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a href="{{ route('user.settings') }}"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    @endif
                                                    {{-- <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li> --}}
                                                    <li><a class="dark-switch active" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                 <ul class="link-list">
                                                    <li><a href="{{ route('user.logout') }}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>