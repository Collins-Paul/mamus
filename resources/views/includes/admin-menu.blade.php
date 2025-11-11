<div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('admin.index') }}" class="logo-link nk-sidebar-logo">
                {{-- <img class="logo-light logo-img" src="{{ asset('assets/logo/rbc-logo2.png') }}" srcset="{{ asset('assets/logo/rbc-logo2.png') }} 2x" alt="logo"> --}}
                <img class="logo-dark logo-img" src="{{ asset('assets/logo/'.$logo->logo) }}" srcset="{{ asset('assets/logo/'.$logo->logo) }} 2x" alt="logo-dark">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-body" data-simplebar>
            <div class="nk-sidebar-content">
                <div class="nk-sidebar-menu">
                    <!-- Menu -->
                    <ul class="nk-menu">
                        <li class="nk-menu-item active">
                            <a href="{{ route('admin.index') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                <span class="nk-menu-text">Dashboard</span>
                            </a>
                        </li>

                        <li class="nk-menu-item active">
                            <a href="{{ route('admin.traders') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                <span class="nk-menu-text">All Investors/Traders</span>
                            </a>
                        </li>

                        <li class="nk-menu-item active">
                            <a href="{{ route('admin.new.master') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-plus"></em></span>
                                <span class="nk-menu-text">Create Master</span>
                            </a>
                        </li>
                        <li class="nk-menu-item active">
                            <a href="{{ route('admin.masters') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                <span class="nk-menu-text">All Master Traders</span>
                            </a>
                        </li>

                        <li class="nk-menu-item active">
                            <a href="{{ route('admin.wallets') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-wallet-alt"></em></span>
                                <span class="nk-menu-text">App Wallets</span>
                            </a>
                        </li>

                        <li class="nk-menu-item">
                            <a href="{{ route('admin.all-history') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-history"></em></span>
                                <span class="nk-menu-text">Transaction History</span>
                            </a>
                        </li>

                        <li class="nk-menu-item">
                            <a href="{{ route('admin.opened-trades') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar-check"></em></span>
                                <span class="nk-menu-text">Opened Order</span>
                            </a>
                        </li>

                        <li class="nk-menu-item">
                            <a href="{{ route('admin.closed-trades') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-calendar"></em></span>
                                <span class="nk-menu-text">Closed Order</span>
                            </a>
                        </li>

                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-copy"></em></span>
                                <span class="nk-menu-text">Copy Trades</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.copy-trades.open') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-trend-up"></em></span> Open</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.copy-trades.closed') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-trend-up"></em></span> Closed</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-invest"></em></span>
                                <span class="nk-menu-text">Subscriptions</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.sub.plans') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-invest"></em></span> List</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.subscription.list') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-invest"></em></span> Robot Subscribed</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.create.plans') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-plus"></em></span> Create</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li>

                        {{-- <li class="nk-menu-item">
                            <a href="{{ route('admin.compose.mail') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-mail"></em></span>
                                <span class="nk-menu-text">Mail</span>
                            </a>
                        </li> --}}

                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-invest"></em></span>
                                <span class="nk-menu-text">Investment Plans</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.packages.create') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-plus"></em></span> Create</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.packages.index') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span> Plans</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li>

                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-property-add"></em></span>
                                <span class="nk-menu-text">CMS</span>
                            </a>
                            <ul class="nk-menu-sub">
                                {{-- <li class="nk-menu-item">
                                    <a href="{{ route('admin.testifiers.all') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-quote-left"></em></span> Testimonies</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.awards.all') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-cards"></em></span> Awards</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.team.memb') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-users"></em></span> Management Team</span></a>
                                </li> --}}
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.edit.logo') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-maximize"></em></span> App Icon/Logo</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.livechat.update.form') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-headphone"></em></span> Livechat Url</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.contacts.create') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-location"></em></span> Contacts/Phone No.</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('admin.admin.whatsapp.form') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-whatsapp"></em></span> WhatsApp Widget</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li>

                        <li class="nk-menu-item">
                            <a href="{{ route('admin.settings') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                <span class="nk-menu-text">Settings</span>
                            </a>
                        </li>

                        <li class="nk-menu-item">
                            <a href="{{ route('user.logout') }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-signout"></em></span>
                                <span class="nk-menu-text">Logout</span>
                            </a>
                        </li>
                    </ul><!-- .nk-menu -->
                </div><!-- .nk-sidebar-menu -->
            </div><!-- .nk-sidebar-content -->
        </div><!-- .nk-sidebar-body -->
    </div><!-- .nk-sidebar-element -->
</div>
