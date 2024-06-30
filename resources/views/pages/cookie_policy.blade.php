@extends('layouts/master')

@section('content')
    {!! $page->title('Cookie Policy') !!}
    {!! $page->addJS('<script src="/js/dialog.js">') !!}
    @include('partials/selling_points_bar')
    <style>
        .legal {
            padding:2rem 0;
        }
        .legal h1 {
            font-size:1.8rem;
        }
        .legal h2 {
            font-size:1.3rem;
        }
    </style>
    @php
        $website = parse_url(request()->root())['host'];
    @endphp
    <div class="grid-container">
        <div class="grid-x">
            <div class="large-12 medium-12 small-12">

                <div class="legal">
                    <h1>Cookie Policy</h1>
                    <p>
                        This Cookie Policy explains how {{$config['company_name']}} ("Company", "we", "us", and "our") uses cookies and similar technologies to recognize you when you visit our websites at {{$website}}, ("Websites"). It explains what these technologies are and why we use them, as well as your rights to control our use of them.
                    </p>
                    <p>
                        In some cases we may use cookies to collect personal information, or that becomes personal information if we combine it with other information.
                    </p>

                    <h2>What are cookies</h2>

                    <p>
                        Cookies are small data files that are placed on your computer or mobile device when you visit a website. Cookies are widely used by website owners in order to make their websites work, or to work more efficiently, as well as to provide reporting information.
                    </p>

                    <p>
                        Cookies set by the website owner (in this case, {{$config['company_name']}}) are called "first party cookies". Cookies set by parties other than the website owner are called "third party cookies". Third party cookies enable third party features or functionality to be provided on or through the website (e.g. like advertising, interactive content and analytics). The parties that set these third party cookies can recognize your computer both when it visits the website in question and also when it visits certain other websites.
                    </p>

                    <h2>Why do we use cookies?</h2>

                    <p>
                        We use first and third party cookies for several reasons. Some cookies are required for technical reasons in order for our Websites to operate, and we refer to these as "essential" or "strictly necessary" cookies. Other cookies also enable us to track and target the interests of our users to enhance the experience on our Online Properties. Third parties serve cookies through our Websites for advertising, analytics and other purposes. This is described in more detail below.
                    </p>

                    <p>
                        The specific types of first and third party cookies served through our Websites and the purposes they perform are described below (please note that the specific cookies served may vary depending on the specific Online Properties you visit):
                    </p>

                    <h2>How can I control cookies?</h2>

                    <p>
                        You have the right to decide whether to accept or reject cookies. You can exercise your cookie rights by setting your preferences in the Cookie Consent Manager. The Cookie Consent Manager allows you to select which categories of cookies you accept or reject. Essential cookies cannot be rejected as they are strictly necessary to provide you with services.
                    </p>

                    <p>
                        The Cookie Consent Manager can be found in the notification banner and on our website. If you choose to reject cookies, you may still use our website though your access to some functionality and areas of our website may be restricted. You may also set or amend your web browser controls to accept or refuse cookies. As the means by which you can refuse cookies through your web browser controls vary from browser-to-browser, you should visit your browser's help menu for more information.
                    </p>
                    <p>

                        In addition, most advertising networks offer you a way to opt out of targeted advertising. If you would like to find out more information, please visit <a href="https://www.aboutads.info/choices/" target="_blank" rel="external">https://www.aboutads.info/choices/</a> or <a href="https://www.aboutads.info/choices/" target="_blank" rel="external">https://www.youronlinechoices.com</a>.
                    </p>
                    <p>
                        The specific types of first and third party cookies served through our Websites and the purposes they perform are described in the table below (please note that the specific cookies served may vary depending on the specific Online Properties you visit):

                    </p>


                    <h2>
                        What about other tracking technologies, like web beacons?
                    </h2>

                    <p>
                        Cookies are not the only way to recognize or track visitors to a website. We may use other, similar technologies from time to time, like web beacons (sometimes called "tracking pixels" or "clear gifs"). These are tiny graphics files that contain a unique identifier that enable us to recognize when someone has visited our Websites or opened an e-mail including them. This allows us, for example, to monitor the traffic patterns of users from one page within a website to another, to deliver or communicate with cookies, to understand whether you have come to the website from an online advertisement displayed on a third-party website, to improve site performance, and to measure the success of e-mail marketing campaigns. In many instances, these technologies are reliant on cookies to function properly, and so declining cookies will impair their functioning.
                    </p>



                    <h2>
                        Do you serve targeted advertising?
                    </h2>
                    <p>

                        Third parties may serve cookies on your computer or mobile device to serve advertising through our Websites. These companies may use information about your visits to this and other websites in order to provide relevant advertisements about goods and services that you may be interested in. They may also employ technology that is used to measure the effectiveness of advertisements. This can be accomplished by them using cookies or web beacons to collect information about your visits to this and other sites in order to provide relevant advertisements about goods and services of potential interest to you. The information collected through this process does not enable us or them to identify your name, contact details or other details that directly identify you unless you choose to provide these.
                    </p>

                    <h2>How often will you update this Cookie Policy?</h2>

                    <p>
                        We may update this Cookie Policy from time to time in order to reflect, for example, changes to the cookies we use or for other operational, legal or regulatory reasons. Please therefore re-visit this Cookie Policy regularly to stay informed about our use of cookies and related technologies.
                    </p>
                    <p>
                        The date at the top of this Cookie Policy indicates when it was last updated.
                    </p>

                    <h2>Where can I get further information?       </h2>
                    <p>
                        If you have any questions about our use of cookies or other technologies, please email us at {{$config['company_email']}} or by post to:
                    </p>
                    <p>
                        @foreach($address as $al)
                            <span>{{$al}}</span><br>
                        @endforeach
                    </p>
                </div>


            </div>
        </div>
    </div>
    @include('partials/stalker')
@endsection
