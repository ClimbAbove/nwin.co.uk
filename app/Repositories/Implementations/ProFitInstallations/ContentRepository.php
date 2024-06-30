<?php

namespace App\Repositories\Implementations\ProFitInstallations;


use App\DTOs\TestimonialDTO;
use App\DTOs\TestimonialsDTO;
use App\Repositories\Content\DefaultContentRepository;
use App\Repositories\Interfaces\ContentRepositoryInterface;
use Carbon\Carbon;

class ContentRepository extends DefaultContentRepository implements ContentRepositoryInterface
{

    public function getHero()
    {
        $hero = [];


        $hero['h1']         = 'SALE NOW ON';
        $hero['h2']         = 'Window & Door Experts.';
        $hero['hero_image'] = '/images/partners/eco-tech-conservatories/hero.png';
        $hero['hero_selling_points'] = [
            'Guaranteed Lowest Price',
            'Free Expert Advice',
            'Friendly & Local Installers',
            '25+ Years Experience',
            '100% Fixed Price Quote',
            '10 Year Warranties',
        ];
        $hero['hero_selling_points_mobile'] = [
            'Guaranteed Lowest Price',
            'Free Expert Advice',
            '100% Fixed Price Quote',
            '25+ Years Experience',
        ];

        $hero['review_partners'] = [

            [
                'image' => '/images/logos/googlereviews.png',
                'href' => 'https://www.google.com/search?q=pro-fit+window+installations+ltd&rlz=1C1GCEA_enGB1015GB1015&oq=pro&aqs=chrome.0.69i59j69i57j69i61l2j69i60l4.1592j0j7&sourceid=chrome&ie=UTF-8#lrd=0x4871cfa76d377ad1:0xbc334955c409b896,1,,,',
            ],
            [
                'image' => '/images/logos/facebookreviews.png',
                'href' => 'https://www.facebook.com/profitwindowinstallationsltd/reviews',
            ],
        ];

        return $hero;
    }

    public function getConfig()
    {
        $config = [];
        $config['partner']          = 'profitinstallations';
        $config['css']              = '/css/partners/profitinstallations/styles.css';
        $config['logo']             = '/images/partners/profitinstallations/logo.png';
        $config['footer_logo']      = '/images/partners/profitinstallations/logo_white.png';
        $config['company_name']     = 'Pro-Fit Window Installation Ltd';
        $config['company_number']   = '13140014';
        $config['company_email']   = 'sales@pro-fitwindowinstallations.co.uk';
        $config['vat_number']       = '';
        $config['tracking_product'] = 'windows_and_doors';

        // Times
        $config['opening_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 7:00:00');
        $config['closing_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 19:00:00'); // summer - 1 7m
        $config['closing_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 18:00:00'); // summer - 1 7m

        if(Carbon::now()->setTimezone('Europe/London')->between($config['opening_time_carbon'],  $config['closing_time_carbon'])) {
            $config['contact_mode'] = 'telephone';
            $config['telephone'] = [
                'international' =>  '+447447024816',
                'number' => '07447 024816',
            ];

        } else {
            $config['contact_mode'] = 'form';
            $config['contact_url'] = route('page-quote');

            $config['telephone'] = [
                'international' =>  '+447447024816',
                'number' => '07447 024816',
            ];
        }

        return $config;
    }

    public function getAddress()
    {
        return [
            'Pro-Fit Installations',
            '',
            '',
            '',
        ];
    }


    public function getMasonry()
    {
        return [
            [
                'text'     => 'Composite Doors',
                'sub_text' => 'Our  composite doors are an affordable solution to replacing your existing wooden or PVC doors. We can supply an extensive range of contemporary and traditional composite doors that offer excellent value for money, impressive thermal efficiency, extra security and are made to suit your exact requirements.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/ODL-composite-door-beige-RSTC-380x270.jpg',
            ],
            [
                'text'     => 'Windows',
                'sub_text' => 'Our uPVC windows contain a unique compound that guarantees a smooth, high gloss finish meaning that your new windows retain their pristine appearance for years to come. This also means that they will never rot or warp and, of course. We offer a wide range of Colours to suit your property and style.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/upvc-rehaus-windows-RSTC-380x270.jpg',

            ],
            [
                'text'     => 'Conservatory Roofs',
                'sub_text' => 'There are instant benefits to replacing your existing conservatory roof panels with insulated panels! You will Reduce energy bills, regulate temperature and reduce noise & UV rays. The best bit is this work can all be done in 1 day! ',

                'image'    => '/assets/images/partners/eco-tech-conservatories/solid-dark-grey-conservatory-roof-RSTC-380x270.jpg',
            ],
            [
                'text'     => 'Bi Fold / Sliding Door',
                'sub_text' => 'We offer a superior quality and range of bespoke Bi Folding and Sliding doors to suit every style of property. Bringing the outdoors into your home! Choose from a wide range of exponential colours. ',
                'image'    => '/assets/images/partners/eco-tech-conservatories/upvc-rehaus-windows-RSTC-380x270.jpg',
            ],
            [
                'text'     => 'Conservatories',
                'sub_text' => 'Conservatories are the perfect way to extend your living space and bring the outdoors indoors. We offer a fantastic range of Ultraframe conservatories so there\'s a style to suit all properties.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/classic-conservatory-roof-with-grey-panels-RSTC-380x270.jpg',
            ],
            [
                'text'     => 'Patio & French Doors',
                'sub_text' => 'We offer a huge range of patio and french doors to suit all tastes and budgets. These offer all the benefits of modern uPVC including noise reduction, energy efficiency, low maintenance and extra security.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/REHAU-french-door-RSTC-380x270.jpg',
            ],

        ];


    }


    public function getWhyCustomersLoveUs()
    {


    }

    public function getTestimonials()
    {

        $testimonials_dto = new TestimonialsDTO();

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "";
        $testimonial_dto->caption = "Matt and the team were very friendly and professional. From quoting to completion there was great communication. The job was completed (7 windows) to a high spec and I am really impressed. Would highly recommend";
        $testimonial_dto->author = "Andrew Slater";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "";
        $testimonial_dto->caption = "Recently had windows, doors and gutter/fascias fitted May 2024. Very professional staff. Completed work on time. Excellent standard of work. Highly recommended. Will have further work carried out in the future.";
        $testimonial_dto->author = "Kevin Carpenter";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "";
        $testimonial_dto->caption = "Pro-fit provided us with a full set of new windows and doors with a quiet and friendly efficiency throughout the process from the initial quotation to a neat and tidy installation. The work was excellently finished for a very fair price. Strongly recommended.";
        $testimonial_dto->author = "Roger Coe";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "";
        $testimonial_dto->caption = "Very happy with the service from start to finish. Ask for a quote and they came out and measured up, asked what we wanted and weren't pushy or looking to upsell. Was giving a good price, paid the deposit and was able to pay the remaining at ...";
        $testimonial_dto->author = "Jacob Jones";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "";
        $testimonial_dto->caption = "Very professional and easy to deal with. Highly recommended to anyone looking to have any double glazing works undertaken.";
        $testimonial_dto->author = "Greg Foster";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "";
        $testimonial_dto->caption = "Really pleased with the windows and doors, , clean workmanship, friendly family run business but very professional service, definitely will use their service again when I’m ready to have the back of my house done .";
        $testimonial_dto->author = "Christina Llewellyn";
        $testimonials_dto->addTestimonial($testimonial_dto);
        return $testimonials_dto;

    }


    public function getFAQs()
    {

        return [
            [
                'question' => 'Are your quotes actually 100% Fixed?  ',
                'answer' => [
                    'Yes, they are! We are really proud to be setting an example in our industry. Our customers have complete peace of mind, the price they see is the price you pay, that\'s a promise. '
                ]
            ],
            [
                'question' => 'What happens if I find a cheaper Quote?',
                'answer' => [
                    'We are so confidant in the products we supply and our competitive prices, that we offer a price beat guarantee by £100, should you get a quote for the exact same product and installation service.'
                ]
            ],
            [
                'question' => 'Will new Windows and doors save me money on my energy bills?',
                'answer' => [
                    'Yes. uPVC should save you money if converting from single glass to double glazing or just really old uPVC windows. According to the energy saving trust. You could save £195 a year and 330 kg of CO2 in a single-glazed, semi-detached gas-heated property with single-glazed windows. It is possible that you could save up to £235 a year and 405 kg of carbon dioxide if you replace single-glazed windows with A++-rated double-glazed ones. Double or triple glazing windows are a great long term energy saving investment, which as a bonus could increase your property value.'
                ]
            ],
            [
                'question' => 'Do newly installed Windows and doors decrease external noise?',
                'answer' => [
                    'If you can hear noise outside your windows are mostly likely old or are failing and it\'s a good time to make the decision to replace your windows. By installing new uPVC windows you could achieve a significant noise reduction, which can be a key decision when buying new double or triple glazing windows for your home. Noise pollution can be reduced by new energy efficient windows.'
                ]
            ],
            [
                'question' => 'What is the difference between Double and Triple glazing?',
                'answer' => [
                    'The main reason customers choose triple glazing is for energy efficiency reasons, Triple glazing should make your house warmer! Having three panes of glass and a further two insulated spaces in between, will make it the best at preventing heat escaping your home through your windows. Triple glazing will prevent more noise from outside traveling into your home, which is great if you live near a main or busy Road. Triple glazing is more expensive than double glazing, by around £300 per window, depending on the size and shape.'
                ]
            ],
            [
                'question' => 'How do I know if I should invest in new windows or repair my existing one’s? ',
                'answer' => [
                    'Windows will typically last between 15 and 25 years depending on the quality. When windows are Beyond economical repair, you should consider making that commercial decision to replace them sooner, rather than later! The following reasons are typically a indication you should make this investment: If The Windows are rotten or worn out, High energy bills or having to run your boiler for long period of time in the winter to heat your home, increase in noise from outside, Damp or your room feeling damp, your window / doors struggle to open or close and your windows are leaking.'
                ]
            ],
            [
                'question' => 'Will new windows & Doors add value to my home?',
                'answer' => [
                    'Yes. Research shows that houses typically increase with double or triple glazing. Your property will stand out by having new windows and doors, which should increase the likelihood to sell your property fast. New windows and Doors will increase the Energy Performance certificate, which is really important as new home owners are looking for energy saving benefits to a property.',
                ]
            ],
            [
                'question' => 'What Colours do uPVC windows come in?',
                'answer' => [
                    'Many of us just think of White windows, but there are now some fantastic colours that can have a significant impact on the way a property looks, our team will work with you and give you a choice of colour that might suit your taste and most importantly your property. Please see a list of some of our most popular colours,',
                    '<ul><li>Agate Grey.</li><li>Anthracite Grey.</li><li>Black Ash.</li><li>Chartwell Green.</li><li>Cream.</li><li>Golden Oak.</li><li>Grey Aluminium.</li><li>Ice Cream.</li><li>Nut Tree.</li></ul>',
                    'But we also offer a wide variety of coloured glass to match any aesthetics of a property, if required. '
                ],
            ],
            [
                'question' => 'Do you offer any product guarantee with your products?',
                'answer' => [
                    'Yes, we offer a 10 year warranty on all of our products to ensure complete customer satisfaction and peace of mind, that we have supplied and installed leading quality products. '
                ]
            ],
            [
                'question' => 'How long do installations take? ',
                'answer' => [
                    'If you are looking to install new windows and doors, for an average size property we usually advise 5 days. But we offer a 100% fixed price quote, so regardless of how long it takes us to install you pay the price we quoted!',
                    'If you’re looking to replace your conservatory roof with insulated panels, this will take 1 day. For solid conservatory roof replacements it will usually take 2-3 days and for larger projects like new conservatories this could take 1-2 weeks to install.',
                ]
            ],
        ];

    }

}
