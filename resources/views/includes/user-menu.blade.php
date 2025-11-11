<ul class="nk-menu">
    @php
    if (Auth::user()->status == 0) {
         $status = '<span class="blink_me badge rounded-pill bg-danger">Unverified</span>';
     } else {
         $status = '<span class="blink_me badge rounded-pill bg-success">Live</span>';
     }
 @endphp
    <li class="nk-menu-heading mb-3">
        <div class="d-flex justify-content-between">
            <h6 class="overline-title text-primary-alt">{!! $status !!} Account</h6>
            <div class="custom-control custom-switch">
                <input type="checkbox" checked class="custom-control-input" id="customSwitch1">
                {{-- <label class="custom-control-label" for="customSwitch1"></label> --}}
            </div>
        </div>
    </li>

    <li class="nk-menu-heading mb-3">
        <a href="{{ route('user.robot.setup') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><img src="{{ asset('assets/images/robot-trading.jpeg') }}" alt=""></span>
            <span class="nk-menu-text ps-2 fw-bold">Robot Auto Trading</span>
        </a>
    </li>

    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Menu</h6>
    </li>

    <li class="nk-menu-item active">
        <a href="{{ route('user.overview') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
            <span class="nk-menu-text">Account Overview</span>
        </a>
    </li>

    <li class="nk-menu-item active">
        <a href="{{ route('user.index') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-wallet-alt"></em></span>
            <span class="nk-menu-text">Wallet</span>
        </a>
    </li>

    <li class="nk-menu-item">
        <a href="{{ route('user.deposit') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-money"></em></span>
            <span class="nk-menu-text">Deposit</span>
        </a>
    </li>
    
    <li class="nk-menu-item">
        <a href="{{ route('user.user.create.user-card') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-cards"></em></span>
            <span class="nk-menu-text">Cards</span>
        </a>
    </li>

    <li class="nk-menu-item has-sub">
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon"><img src="{{ asset('assets/images/robot-trading.jpeg') }}" style="width: 30px" alt=""></span>
            <span class="nk-menu-text">Robot</span>
        </a>
        <ul class="nk-menu-sub">
            <li class="nk-menu-item">
                <a href="{{ route('user.robot.subscription') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-invest"></em></span> Subscription</span></a>
            </li>
            <li class="nk-menu-item">
                <a href="{{ route('user.robot.history', ['type'=>'opened']) }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-tranx"></em></span> Open Order</span></a>
            </li>
            <li class="nk-menu-item">
                <a href="{{ route('user.robot.history', ['type'=>'closed']) }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-history"></em></span> Closed Order</span></a>
            </li>
        </ul><!-- .nk-menu-sub -->
    </li>

    <!--<li class="nk-menu-item has-sub">-->
    <!--    <a href="#" class="nk-menu-link nk-menu-toggle">-->
    <!--        <span class="nk-menu-icon"><em class="icon ni ni-trend-up"></em></span>-->
    <!--        <span class="nk-menu-text">Live Trades</span>-->
    <!--    </a>-->
    <!--    <ul class="nk-menu-sub">-->
    <!--        <li class="nk-menu-item">-->
    <!--            <a href="{{ route('user.place.order') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-trend-up"></em></span> Place Order</span></a>-->
    <!--        </li>-->
    <!--        <li class="nk-menu-item">-->
    <!--            <a href="{{ route('user.opened-trades') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-tranx"></em></span> Open Order</span></a>-->
    <!--        </li>-->
    <!--        <li class="nk-menu-item">-->
    <!--            <a href="{{ route('user.closed-trades') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-history"></em></span> Closed Order</span></a>-->
    <!--        </li>-->
    <!--    </ul>-->
    <!--</li>-->


    @if (Auth::user()->copy_trade == 'yes')
    <li class="nk-menu-item has-sub">
        <a href="{{ route('user.copier') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-trend-up"></em></span>
            <span class="nk-menu-text">Copy Area</span>
        </a>
    </li>
    @else
        <li class="nk-menu-item has-sub">
            <a href="{{ route('user.copier') }}" class="nk-menu-link">
                <span class="nk-menu-icon"><em class="icon ni ni-trend-up"></em></span>
                <span class="nk-menu-text">Equity/Statistics</span>
            </a>
        </li>
    @endif

    <li class="nk-menu-item has-sub">
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
            <span class="nk-menu-text">Investment</span>
        </a>
        <ul class="nk-menu-sub">
            <li class="nk-menu-item">
                <a href="{{ route('user.investment.plans') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span>Investment Plans</span></a>
            </li>
            <li class="nk-menu-item">
                <a href="{{ route('user.my.active.investment') }}" class="nk-menu-link"><span class="nk-menu-text"><span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span> My Investment</span></a>
            </li>
        </ul><!-- .nk-menu-sub -->
    </li>

    <li class="nk-menu-item">
        <a href="{{ route('user.settings') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
            <span class="nk-menu-text">Settings</span>
        </a>
    </li>

    {{-- <li class="nk-menu-item">
        <a href="{{ route('user.contact') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-mail"></em></span>
            <span class="nk-menu-text">Contact Us</span>
        </a>
    </li>

    <li class="nk-menu-item">
        <a href="{{ $liveChat->url }}" target="_blank" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-headphone"></em></span>
            <span class="nk-menu-text">Start LiveChat</span>
        </a>
    </li> --}}

    {{-- <li class="nk-menu-item">
        <a href="{{ asset('receipt/investors-trading-agreement.pdf') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-caution"></em></span>
            <span class="nk-menu-text">Terms & Conditions</span>
        </a>
    </li> --}}

    <li class="nk-menu-item">
        <a href="{{ route('user.logout') }}" class="nk-menu-link">
            <span class="nk-menu-icon"><em class="icon ni ni-signout"></em></span>
            <span class="nk-menu-text">Logout</span>
        </a>
    </li>
</ul><!-- .nk-menu -->
