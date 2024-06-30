@extends('layouts/master')

@section('content')
    {!! $page->title('Terms and Conditions') !!}
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

    <div class="grid-container">
        <div class="grid-x">
            <div class="large-12 medium-12 small-12">

                <div class="legal">
                    <h1>Terms and Conditions</h1>

                    <h2>Website access</h2>
                    <p>
                        Access to our ({{$config['company_name']}})  Website is permitted on a temporary basis and we ({{$config['company_name']}}) reserve the right to amend, cancel or withdraw a service we provide on our website, without any notice given. If our website is unavailable for any period of time (with no limit) Climb Above Limited will not be liable.
                    </p>


                    <h2>Acceptable use</h2>
                    <p>
                        You are only permitted to use our website for lawful purposes. You may not use our website in any way that does or could breach any UK or International Law, regulations, unlawful or fraudulent purposes. You also agree to not interfere, disrupt, Damage, access with our written authority any parts of our website, Network or IT infrastructure on which our website is stored.
                    </p>
                    <h2>Intellectual Property</h2>
                    <p>
                        For Personal Reference (only) you may print off one copy or download extracts of a page from our website. This License does not permit the incorporation of the material or any part of it, in any other work, publication or website ,whether in hard copy or electronic or another form. You Must not modify the digital copies or the paper copy of any materials you have printed off or downloaded in any way, and you must not use Graphics, Icons, Photographs, Bespoke videos, illustrations separately from any accompanying text. You must not use for commercial reasons or purposes any materials from our website without a license or written consent from Climb Above Limited Should you breach our website site terms, your right to use our website will cease with immediate effect and you must destroy or return any copies of the materials you have made.
                    </p>
                    <h2>Reliance on information posted</h2>
                    <p>
                        Material or Commentary posted on our website, are not intended to amount to advice on which reliance should be placed. If using the website, you (Users) should not take or omit to take any action that relies on the information displayed on our website. We will make an effort and try to ensure that material displayed on our website is accurate and we provide this for information purposes only. Our material or commentary is indicative, rather than definitive. We make implicit or explicit guarantees of their accuracy, and, as far as applicable laws allow, we do not accept any responsibility for inaccuracies, omissions or errors. This also includes no loss that might result (indirectly or Directly) from the reliance placed on martials or commentary posted or visible on our website.
                    </p>
                    <h2>Our Website will change</h2>
                    <p>
                        We aim to keep our website updated and we will change the content at any time. We might require you to suspend access to our website to make these changes. Any information that can be found on our website, could be out of date at any given time. ({{$config['company_name']}}) are not under any obligation to update such material.
                    </p>
                    <h2>Liability</h2>
                    <p>
                        Use of our website is free of Charge. The material that is displayed publicly on our website is provided at no guarantee, warranties, conditions to its accuracy. To the extent permitted by law, we, other members of our group of companies and third parties connected to us hereby expressly exclude: all conditions, warranties and other terms which might otherwise be implied by statute, common law or the law of equity; any and all liability (whether arising in contract, tort or otherwise) for any direct, indirect or consequential loss or damage incurred by any user in connection with our Website or in connection with the use, inability to use, or results of the use of our Website, any websites linked to it and any materials posted on it. This does not affect our liability for death or personal injury arising from our negligence, or our liability for fraudulent misrepresentation or misrepresentation as to a fundamental matter, or any other liability which cannot be excluded or limited under applicable UK law
                    </p>
                    <h2>Information regarding visitors to our website</h2>
                    <p>
                        We will process information about you in accordance with our privacy policy and inline with the GDPR. By Using our website, you consent to such processing and you warrant that all Data provided by you is accurate. If you wish to amend your details at any time, please make contact with us.
                    </p>
                    <h2>Linking to our website</h2>
                    <p>
                        You are permitted to link to our main homepage or other pages on our website. You must in a fair and legal way that does not damage our brand or reputation. You must not establish a link or connection in a way that you suggest a form or association, approval or endorsement on our part, without our consent in writing or where none exists. You are not permitted to establish a link from any website that is not operated by you. We reserve the right to completely withdraw linking to our website, without any notice given. The website that you are linking from must comply with all respects to UK / International law, all regulations and good practices.
                    </p>
                    <h2>Link from our website</h2>
                    <p>
                        Our website might contain links to other websites provided by us or provided by third parties. These links are provided for you information only. We do not have control over the content of those resources or websites and accept no responsibility from them. This includes any damage or loss that could arise from your use of them.
                    </p>
                    <h2>Law and jurisdiction</h2>
                    <p>
                        The UK courts will have exclusive jurisdiction over any claim arising from, or related to, a visit to our website, we reserve the right to bring proceedings against you for the breach of these conditions in your country of residence or any relevant country. Our Terms and conditions are governed by English Law.
                    </p>
                    <h2>Variations</h2>
                    <p>
                        We may revise these terms and conditions of use at any time by editing or amending this page. You are expected to check this page from time to time to take notice of any changes we made, as they are binding on you. Some of the provisions contained in these terms of use may also be superseded by provisions or notices published elsewhere on our Website.
                    </p>
                    <h2>Privacy policy changes</h2>
                    <p>
                        If we make changes to our Privacy policy in the future, this will be published on this page
                    </p>


                </div>

            </div>
        </div>
    </div>
    @include('partials/stalker')
@endsection
