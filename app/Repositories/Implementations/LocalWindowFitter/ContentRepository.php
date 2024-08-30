<?php

namespace App\Repositories\Implementations\LocalWindowFitter;


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
                'image' => '/images/logos/trustpilot-stars.png',
                //    'href' => 'https://www.facebook.com/profitwindowinstallationsltd/reviews',
            ],
        ];

        return $hero;
    }

    public function getConfig()
    {
        $config = [];
        $config['partner']          = 'localwindowfitter';
        $config['css']              = '/css/partners/localwindowfitter/styles.css';
        $config['logo']             = '/images/partners/localwindowfitter/logo-black.png';
        $config['footer_logo']      = '/images/partners/localwindowfitter/logo.png';
        $config['company_name']     = 'ONKAR (J&S) Limited';
        $config['company_number']   = '13265542';
        $config['company_email']   = 'info@onkarwindows.com';
        $config['vat_number']       = '';
        $config['tracking_product'] = 'windows_and_doors';

        // Times
        $config['opening_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 7:00:00');
        $config['closing_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 19:00:00'); // summer - 1 7m
        //$config['closing_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 18:00:00'); // summer - 1 7m

        if(Carbon::now()->setTimezone('Europe/London')->between($config['opening_time_carbon'],  $config['closing_time_carbon'])) {
            $config['contact_mode'] = 'telephone';
            $config['telephone'] = [
                'international' =>  '+44113 8715099',
                'number' => '0113 8715099',
            ];

        } else {
            $config['contact_mode'] = 'form';
            $config['contact_url'] = route('page-quote');

            $config['telephone'] = [
                'international' =>  '+44113 8715099',
                'number' => '0113 8715099',
            ];
        }

        return $config;
    }

    public function getAddress()
    {
        return [
            'ONKAR (J&S) Limited',
            'Unit 1 Gold Spot Business Centre',
            'Scotch Park Trading Estate',
            'Forge Ln',
            'Armley',
            'Leeds',
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
                'sub_text' => 'Our uPVC windows contain a unique compound that guarantees a smooth, high gloss finish, meaning that your new windows retain their pristine appearance for years to come. This also means that they will never rot or wrap. We of course offer a wide range of colours to suit your property and style.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/upvc-rehaus-windows-RSTC-380x270.jpg',

            ],
            [
                'text'     => 'Conservatory Roofs',
                'sub_text' => 'There are instant benefits to replacing your existing conservatory roof panels with insulated panels! You will reduce energy bills, regulate temperature and reduce noise & UV rays. The best bit is that this work can all be done in 1 day.',

                'image'    => '/assets/images/partners/eco-tech-conservatories/solid-dark-grey-conservatory-roof-RSTC-380x270.jpg',
            ],
            [
                'text'     => 'Bi Fold/Sliding Door',
                'sub_text' => 'We offer a superior quality and range of bespoke Bi folding and sliding doors to suit every style of property. Bringing the outdoors into your home! Choose from a wide range of exponential colours.',
                'image'    => '/assets/images/product-grid/bifolds-RSTC-380x270.jpg',
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
        $testimonial_dto->title = "Trustworthy and reliable";
        $testimonial_dto->caption = "Trustworthy and reliable. Kept me updated on what was happening and delivered when promised. Would recommend Onkar Windows and Doors to anyone who is looking for an upgrade or replacement.";
        $testimonial_dto->author = "H Sehmbey";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "Excellent work";
        $testimonial_dto->caption = "Came out to look at the job, gave a quote and expected timeframe. Turned up to do the job and left the site tidy. As simple as it should be and very meticulous workmanship!";
        $testimonial_dto->author = "P Singh";
        $testimonials_dto->addTestimonial($testimonial_dto);


        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "100% recommend";
        $testimonial_dto->caption = "100% recommend, we are more than happy with our new front door. Great customer service and communication, thank you!";
        $testimonial_dto->author = "L Hayes";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "Great products and excellent service all round!";
        $testimonial_dto->caption = "Great company! Bought 2 composite doors last November on a Black Friday deal! Since then I have ordered windows for my house and my son has also had a new door fitted! Thanks guys!";
        $testimonial_dto->author = "J Bee";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "Great Service";
        $testimonial_dto->caption = "Called round within 24 hours. Quotes came through same day. I had some questions and always came back to me the same day. They made me feel like they wanted the business.
Great service. Thank you.";
        $testimonial_dto->author = "A Thompson";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "Excellent service";
        $testimonial_dto->caption = "Excellent service by Jason and his team at competitive price, highly recommended";
        $testimonial_dto->author = "G Farid";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "Had 2 doors fitted by these guys";
        $testimonial_dto->caption = "Had 2 doors fitted by these guys, wanted UPVC as I thought that was my budget however they gave me a cracking price on 2 composites. They manufacture everything so I guess it reflects in the price. Happy with it all!";
        $testimonial_dto->author = "R Myers";
        $testimonials_dto->addTestimonial($testimonial_dto);

        return $testimonials_dto;

    }


    public function getFAQs()
    {

        return [
            [
                'question' => 'Are your quotes actually 100% fixed? ',
                'answer' => [
                    'Yes, they are! We are really proud to be setting an example in our industry. Our customers have complete peace of mind, the price they see is the price you pay. That’s a promise.'
                ]
            ],
            [
                'question' => 'What happens if I find a cheaper quote?',
                'answer' => [
                    'We are so confidant in the products we supply and our competitive prices, that we offer a price beat guarantee by £100, should you get a quote for the exact same product and installation service.'
                ]
            ],
            [
                'question' => 'Will new windows and doors save me money on my energy bills?',
                'answer' => [
                    'Yes. uPVC should save you money if converting from single glass to double glazing or just really old uPVC windows. According to the energy saving trust. You could save £195 a year and 330 kg of CO2 in a single-glazed, semi-detached gas-heated property with single-glazed windows. It is possible that you could save up to £235 a year and 405 kg of carbon dioxide if you replace single-glazed windows with A++-rated double-glazed ones. Double or triple glazing windows are a great long term energy saving investment, which as a bonus could increase your property value.'
                ]
            ],
            [
                'question' => 'Do newly installed windows and doors decrease external noise?',
                'answer' => [
                    'If you can hear noise outside your windows are mostly likely old or are failing and it\'s a good time to make the decision to replace your windows. By installing new uPVC windows you could achieve a significant noise reduction, which can be a key decision when buying new double or triple glazing windows for your home. Noise pollution can be reduced by new energy efficient windows.'
                ]
            ],
            [
                'question' => 'What is the difference between double and triple glazing?',
                'answer' => [
                    'The main reason customers choose triple glazing is for energy efficiency reasons. Triple glazing should make your house warmer! Having three panes of glass and a further two insulated spaces in between will make it the best at preventing heat escaping your home through your windows. Triple glazing will prevent more noise from outside traveling into your home, which is great if you live near a main or busy road. Triple glazing is more expensive than double glazing by around £300 per window, depending on the size and shape.'
                ]
            ],
            [
                'question' => 'How do I know if I should invest in new windows or repair my existing ones?',
                'answer' => [
                    'Windows will typically last between 15 and 25 years depending on the quality. When windows are beyond economical repair, you should consider making that commercial decision to replace them sooner, rather than later! The following reasons are typically an indication you should make this investment: If the windows are rotten or worn out, high energy bills or having to run your boiler for long period of time in the winter to heat your home, increase in noise from outside, damp or your room feeling damp, your window / doors struggle to open or close and your windows are leaking.'
                ]
            ],
            [
                'question' => 'Will new windows & doors add value to my home?',
                'answer' => [
                    'Yes. Research shows that houses typically increase with double or triple glazing. Your property will stand out by having new windows and doors, which should increase the likelihood to sell your property fast. New windows and doors will increase the energy performance certificate, which is really important, as new home owners are looking for energy saving benefits to a property.',
                ]
            ],
            [
                'question' => 'What colours do uPVC windows come in??',
                'answer' => [
                    'Many of us just think of white windows, but there are now some fantastic colours that can have a significant impact on the way a property looks. Our team will work with you and give you a choice of colours that might suit your taste and most importantly your property. Please see a list of some of our most popular colours:',
                    '<ul><li>Agate Grey.</li><li>Anthracite Grey.</li><li>Black Ash.</li><li>Chartwell Green.</li><li>Cream.</li><li>Golden Oak.</li><li>Grey Aluminium.</li><li>Ice Cream.</li><li>Nut Tree.</li></ul>',
                    'We also offer a wide variety of coloured glass to match any aesthetics of a property if required.'
                ],
            ],
            [
                'question' => 'Do you offer any product guarantee with your products?',
                'answer' => [
                    'Yes. We offer a 10 year warranty on all of our products to ensure complete customer satisfaction and peace of mind that we have supplied and installed leading quality products.'
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
