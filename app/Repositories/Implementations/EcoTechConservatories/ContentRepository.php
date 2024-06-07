<?php

namespace App\Repositories\Implementations\EcoTechConservatories;


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


        $hero['h1'] = 'Conservatories Experts';
        $hero['h2'] = 'Unbeatable Prices, Unbeatable Quality';
        $hero['hero_image'] = '/images/partners/eco-tech-conservatories/hero.png';

        return $hero;
    }

    public function getConfig()
    {
        $config = [];
        $config['partner']          = 'eco-tech-conservatories';
        $config['css']              = '/css/partners/eco-tech-conservatories/styles.css';
        $config['logo']             = '/images/partners/eco-tech-conservatories/logo.png';
        $config['company_name']     = 'MK Developments and Construction Ltd trading as Eco Tech Conservatories';
        $config['company_number']   = '13943142';
        $config['vat_number']       = '446852270';
        $config['tracking_product'] = 'conservatory';

        // Times
        $config['opening_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 7:00:00');
        $config['closing_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 18:00:00'); // summer - 1 7m

        if(Carbon::now()->setTimezone('Europe/London')->between($config['opening_time_carbon'],  $config['closing_time_carbon'])) {
            $config['contact_mode'] = 'telephone';
            $config['telephone'] = [
                'international' =>  '+448004332251',
                'number' => '0800 433 2251',
            ];

        } else {
            $config['contact_mode'] = 'form';
            $config['contact_url'] = route('page-quote');

            $config['telephone'] = [
                'international' =>  '+448004332251',
                'number' => '0800 433 2251',
            ];
        }

        return $config;
    }

    public function getAddress()
    {
        return [
            'Eco Tech Conservatories',
            '15 Attoxhall Road',
            'Coventry',
            'CV2 5AH',
        ];
    }


    public function getMasonry()
    {
        return [
            [
                'text'     => 'Panelled Conservatory Roofs',
                'sub_text' => 'The benefits of replacing your old conservatory roof panels with insulated panels are plenty! Reduce energy bills, regulate temperature and reduce noise & UV rays. An absolute bonus is it\'s done in a day!',
                'image'    => '/assets/images/partners/eco-tech-conservatories/solid-dark-grey-conservatory-roof-RSTC-380x270.jpg',
            ],
            [
                'text'     => 'Solid Conservatory Roofs',
                'sub_text' => 'Turn your conservatory into a room again. Thermal-efficient glass roofs, lightweight tiled roofs - your options and customisations are endless with Ultraframe.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/tiled-conservatory-roof-ultraroof-interior-RSTC-380x270.jpg',

            ],
            [
                'text'     => 'Conservatories',
                'sub_text' => 'Conservatories are the perfect way to extend your home and bring the outdoors indoors. At Eco Tech, we offer a huge range of Ultraframe conservatories so there\'s a style to suit everyone.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/classic-conservatory-roof-with-grey-panels-RSTC-380x270.jpg',
            ],
            [
                'text'     => 'Windows',
                'sub_text' => 'At Eco Tech, we choose REHAU for our uPVC windows. REHAU windows contain a unique compound that guarantees a smooth, high gloss finish meaning that your new windows retain their pristine appearance for years to come. This also means that they will never warp or rot and, of course, will never need painting.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/upvc-rehaus-windows-RSTC-380x270.jpg',
            ],
            [
                'text'     => 'Composite Doors',
                'sub_text' => 'A composite door is an affordable solution to replacing existing pvc and wooden doors. We can supply a huge range of traditional and contemporary ODL composite doors that offer excellent value for money, impressive thermally efficiency, solid security and are made to suit your exact criteria.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/ODL-composite-door-beige-RSTC-380x270.jpg',
            ],
            [
                'text'     => 'Patio & French Doors',
                'sub_text' => 'At Eco Tech we offer a huge range of patio and french doors by REHAU to suit all tastes and budgets. These offer all the benefits of modern uPVC including noise reduction, low maintenance, safety, security and energy efficiency.',
                'image'    => '/assets/images/partners/eco-tech-conservatories/REHAU-french-door-RSTC-380x270.jpg',
            ],


        ];


    }

    public function getTestimonials()
    {

        $testimonials_dto = new TestimonialsDTO();

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "Exceptional Quality, Endless Delight";
        $testimonial_dto->caption = "I recently had the pleasure of working with Ecotech Conservatories to install a new conservatory in my home, and I couldn't be happier with the results. From start to finish, the team was professional, courteous, and highly skilled. They listened to my needs and preferences, offering valuable suggestions along the way. The quality of their product exceeded my expectations. I now have a beautiful space that I can enjoy all year round thank you Ecotech";
        $testimonial_dto->author = "Ethan H";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "Great Experience";
        $testimonial_dto->caption = "We had such a great experience with Eco Tech. The window fitters were amazing at making the experience as stress free as possible. They were also lovely guys which also helps. The windows are incredible, and have made such a difference to our home. This is the best quote we received by far, and the quality is exceptional! I cannot rate them enough";
        $testimonial_dto->author = "Shaune B";
        $testimonials_dto->addTestimonial($testimonial_dto);

        $testimonial_dto = new TestimonialDTO();
        $testimonial_dto->title = "Great team turned up promptly";
        $testimonial_dto->caption = "Great team turned up promptly, explained to me exactly what they were going to do and got stuck straight into the job even when I asked a question they were great at explaining to me. Really customer focused even doing a bit of work for me for free ( not in the quote ) after completing I rang the office to make final payment which was so smooth and within a minute had a receipt emailed. Would definitely use again not just builders but gentleman builders. Turned my conservatory into a lovable room.";
        $testimonial_dto->author = "Jeremy P";
        $testimonials_dto->addTestimonial($testimonial_dto);

        return $testimonials_dto;

    }


    public function getFAQs()
    {

        return [
            [
                'question' => 'What products do Eco Tech Conservatories offer?',
                'answer' => [
                    'Eco Tech offer a huge range of conservatory products, including traditional conservatories built from scratch, solid conservatory roof replacements such as Ultraframe’s Livinroof, Ultraroof or performance glass roofs. We also offer insulated conservatory roof panels where you maintain the structure of your roof and replace only the panels. Finally we also offer uPVC windows, doors and composite doors.'
                ]
            ],
            [
                'question' => 'Can I get a conservatory custom-built to fit my home?',
                'answer' => [
                    'Absolutely! Nothing is ‘off-the-shelf’.
                    Our professional team custom-build your conservatory, tailored to fit the unique dimensions and style of your home.
                    Similarly, our conservatory roof panels are all made-to-measure and can be customised to your taste and style.'
                ]
            ],
            [
                'question' => 'Are there any financing options available for purchasing a conservatory?',
                'answer' => [
                    'Yes, we offer financing options through Kanda to help make purchasing any of our services more accessible and convenient for our customers.'
                ]
            ],
            [
                'question' => 'What materials are used in the construction of your conservatories?',
                'answer' => [
                    'We use the highest quality materials for all of our products to ensure longevity as well as eco-efficiency. Our insulated panels are proudly made in the UK. They’re crafted from lightweight aluminium and boast 75mm of insulation. We also offer tiled and double/ triple glazing roofing options by Ultraframe.'
                ]
            ],
            [
                'question' => 'Do you offer any guarantees or warranties on your products?',
                'answer' => [
                    'Yes, we offer a 10 year warranty through Home Pro on all of our products to ensure customer satisfaction and peace of mind.'
                ]
            ],
            [
                'question' => 'How energy-efficient are your conservatories?',
                'answer' => [
                    'Our conservatories are designed with energy efficiency in mind, featuring insulated roofs, double or triple-glazed glass panels, and high-quality seals to minimise heat loss and reduce energy consumption.
                    Our conservatory roof replacements excel when it comes to thermal retention.
                    U-Value from 0.15 W/m2k (suitable to meet building regulations)'
                ]
            ],
            [
                'question' => 'Will I need planning permission for installing a conservatory?',
                'answer' => [
                    'It depends but often you can build a conservatory without planning permission. You can build a conservatory without planning permission if: It is a max height of 4m high or 3m high (if within 2m of a boundary), the conservatory does not cover more than half the garden, the roof ridge or top point is not higher than the eaves of a property’s roof. Our team at Eco Tech will guide you through all of this though so please get in touch if you have any questions.',
                ]
            ],
            [
                'question' => 'How long does the installation process take from start to finish?',
                'answer' => [
                    'If you’re looking to replace your polycarbonate conservatory roof with insulated panels, we can often perform these in just a day!
                     For solid conservatory roof replacements it will on-average take 2-4 days and for larger projects like new conservatories or conservatory extensions it will be around 1-2 weeks depending on a few variable factors.',
                ]
            ]
        ];

    }

}
