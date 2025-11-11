    <!-- footer-area -->
    <footer>
        <div class="footer__area-two">
            <div class="footer__bottom-two">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="copyright-text-two">
                                <p>Copyright {{ date('Y') }} © <a href='#'>{{ config('app.name') }}</a> | All Right Reserved</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('home.terms-conditions') }}">Terms of Service</a>
                                <p class="text-white"> | </p>
                                <a href="{{ route('home.privacy-policy') }}">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area-end -->
