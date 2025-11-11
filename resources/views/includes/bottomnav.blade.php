<nav class="pb-3 bg-white navbar-light bg-light">
    <div class="">
        <div class="b-nav d-flex justify-content-between">
            <a href="{{ route('user.copier') }}" class="nk-menu-link text-center">
                <span class="nk-menu-icon"><em class="icon ni ni-grid-c"></em></span>
                <br>
                <span class="fw-lighter">Investment</span>
            </a>
            <a href="{{ route('user.rating') }}" class="nk-menu-link text-center">
                <span class="nk-menu-icon"><em class="icon ni ni-user-circle"></em></span>
                <br>
                <span class="fw-lighter">Rating</span>
            </a>
            <a href="{{ route('user.transactions') }}" class="nk-menu-link text-center">
                <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                <br>
                <span class="fw-lighter">Trades</span>
            </a>
        </div>
    </div>
</nav>
