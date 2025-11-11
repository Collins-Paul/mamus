@extends('layouts.home')

@section('title')
    Terms and Condition
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="row my-5">
                <div class="col-lg-12 mb-5">
                    <h4 style="margin: 20px 0px">{{ config('app.name') }} TERMS OF SERVICE</h4>
                    <p>Last Updated: 01/10/2024</p>
                    <p>
                        These terms of service ("Terms") apply to your access and use of {{ config('app.name') }}
                        (the "Service"). Please read them carefully.
                    </p>

                    <h4 style="margin: 20px 0px">Accepting these Terms</h4>
                    <p>
                        If you access or use the Service, it means you agree to be bound by all of the terms below. So,
                        before you use the Service, please read all of the terms. If you don't agree to all of the terms
                        below, please do not use the Service. Also, if a term does not make sense to you, please let us know
                        by e-mailing {{ config('app.email') }}.
                    </p>

                    <h4 style="margin: 20px 0px">Changes to these Terms</h4>
                    <p>
                        We reserve the right to modify these Terms at any time. For instance, we may need to change these
                        Terms if we come out with a new feature or for some other reason.
                    </p>
                    <p>
                        Whenever we make changes to these Terms, the changes are effective [TIME PERIOD] after we post such
                        revised Terms (indicated by revising the date at the top of these Terms) or upon your acceptance if
                        we provide a mechanism for your immediate acceptance of the revised Terms (such as a click-through
                        confirmation or acceptance button). It is your responsibility to check {{ config('app.name') }} for
                        changes to
                        these Terms.
                    </p>
                    <p>
                        If you continue to use the Service after the revised Terms go into effect, then you have accepted
                        the changes to these Terms.
                    </p>

                    <h4 style="margin: 20px 0px">Privacy Policy</h4>
                    <p>
                        For information about how we collect and use information about users of the Service, please check
                        out
                        our privacy policy available at <a href="{{ route('home.privacy-policy') }}">Pricay Policy</a>.
                    </p>

                    <h4 style="margin: 20px 0px">Third-Party Services</h4>
                    <p>
                        From time to time, we may provide you with links to third party websites or services that we do not
                        own or control. Your use of the Service may also include the use of applications that are developed
                        or owned by a third party. Your use of such third party applications, websites, and services is
                        governed by that party's own terms of service or privacy policies. We encourage you to read the
                        terms and conditions and privacy policy of any third party application, website or service that you
                        visit or use.
                    </p>

                    <h4 style="margin: 20px 0px">Creating Accounts</h4>
                    <p>
                        When you create an account or use another service to log in to the Service, you agree to maintain
                        the
                        security of your password and accept all risks of unauthorized access to any data or other
                        information you provide to the Service.
                    </p>
                    <p>
                        If you discover or suspect any Service security breaches, please let us know as soon as possible.
                    </p>

                    <h4 style="margin: 20px 0px">Alerts, Notifications, and Service Communication</h4>
                    <p>
                        By creating a User Account, you automatically subscribe to various alerts via e-mail and mobile
                        notification. We will not include your password in these communications. Still, we may include your
                        name, e-mail address, and other information necessary for our user. Anyone that has access to your
                        e-mail or mobile device will be able to view these alerts.
                    </p>

                    <h4 style="margin: 20px 0px">Termination</h4>
                    <p>
                        If you breach any of these Terms, we have the right to suspend or disable your access to or use of
                        the Service.
                    </p>

                    <h4 style="margin: 20px 0px">Entire Agreement</h4>
                    <p>
                        These Terms constitute the entire agreement between you and {{ config('app.name') }} regarding the
                        use of the
                        Service, superseding any prior agreements between you and {{ config('app.name') }} relating to your
                        use of
                        the Service.
                    </p>

                    <h4 style="margin: 20px 0px">Feedback</h4>
                    <p>
                        Please let us know what you think of the Service, these Terms and, in general,
                        {{ config('app.name') }}. When you
                        provide us with any feedback, comments or suggestions about the Service, these Terms and, in
                        general, {{ config('app.name') }}, you irrevocably assign to us all of your right, title and
                        interest in and to
                        your feedback, comments and suggestions.
                    </p>

                    <h4 style="margin: 20px 0px">Questions & Contact Information</h4>
                    <p>
                        Questions or comments about the Service may be directed to us at the email address
                        {{ config('app.email') }}.
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
