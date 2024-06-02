<?php

namespace App\Repositories\Implementations\Nwin;


use App\Repositories\Content\DefaultContentRepository;
use App\Repositories\Interfaces\ContentRepositoryInterface;
use Carbon\Carbon;

class ContentRepository extends DefaultContentRepository implements ContentRepositoryInterface
{
    public function getHero()
    {
        $hero = [];

        $hero['h1'] = 'Window & Door Sale';
        $hero['h2'] = 'Unbeatable Prices, Unbeatable Quality';
        $hero['hero_image'] = '/images/partners/nwin/hero.png';

        return $hero;
    }
    public function getConfig()
    {
        $config = [];
        $config['partner'] = 'nwin';
        $config['css'] = '/css/partners/nwin/styles.css';
        $config['logo'] = '/images/partners/nwin/logo.png';
        $config['company_name'] = 'NWIN';
        $config['company_number'] = '1231312';
        $config['vat_number'] = '34234234';

        // Times
        $config['opening_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 8:00:00');
        $config['closing_time_carbon'] = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->setTimezone('Europe/London')->format('Y-m-d') . ' 18:00:00');

        if(Carbon::now()->setTimezone('Europe/London')->between($config['opening_time_carbon'],  $config['closing_time_carbon'])) {
            $config['contact_mode'] = 'telephone';
            $config['telephone'] = [
                'international' =>  '+447368558274',
                'number' => '07369558274',
            ];

        } else {
            $config['contact_mode'] = 'form';
            $config['contact_url'] = route('page-quote');

            $config['telephone'] = [
                'international' =>  '+447368558274',
                'number' => '07369558274',
            ];
        }



        return $config;
    }

    public function getAddress()
    {
        return [
            'NWIN Limited',
            'Discovery Court Business Centre',
            'Suite 11',
            'Wallisdown Rd',
            'Poole',
            'Poole',
        ];
    }

    public function getMasonry()
    {
        return [
            [
                'text'     => 'Windows',
                'sub_text' => '',
                'image'    => '/images/product-grid/windows.jpg',
            ],
            [
                'text'     => 'Conservatory',
                'sub_text' => '',
                'image' => '/images/product-grid/conservatory.jpg',
            ],
            [
                'text'     => 'Sliding Door',
                'sub_text' => '',
                'image' => '/images/product-grid/sliding-door.jpg',
            ],
            [
                'text'     => 'Bi Folds',
                'sub_text' => '',
                'image' => '/images/product-grid/bifolds.jpg',
            ],
            [
                'text'     => 'Orangery',
                'sub_text' => '',
                'image' => '/images/product-grid/orangery.jpg',
            ],
            [
                'text'     => 'Garden Room',
                'sub_text' => '',
                'image' => '/images/product-grid/garden-room.jpg',
            ],

            [
                'text'     => 'Doors',
                'sub_text' => '',
                'image' => '/images/product-grid/doors.jpg',
            ],
            [
                'text'     => 'Porch',
                'sub_text' => '',
                'image' => '/images/product-grid/porch.jpg',
            ],
            [
                'text'     => 'Garage',
                'sub_text' => '',
                'image' => '/images/product-grid/garage.jpg',
            ],
        ];


    }
    public function getFAQs()
    {

        return [
            [
                'question' => 'Who is NWIN?',
                'answer' => [
                    'NWIN - National Window Installer Network. We are the UK’s First Windows and Doors national, powered by the UK’s Best independent installers. Our installers are local in your areas, but operate as a national Group. Although your contract is directly with our Local area partner, they are supported by our large buying power and exclusive group partnerships. Together, NWIN is designed to beat the UK’s current nationals and to change the dated Window and door industry, once and for all!'
                ]
            ],
            [
                'question' => 'Will uPVC windows save me energy?',
                'answer' => [
                    'Yes. uPVC should save you money if converting from single glass to double glazing or just really old uPVC windows. According to the energy saving trust. You could save £195 a year and 330kg of CO2 in a single-glazed, semi-detached gas-heated property with single-glazed windows. It is possible that you could save up to £235 a year and 405kg of carbon dioxide if you replace single-glazed windows with A++-rated double-glazed ones. Double or triple glazing windows are a great long term energy saving investment, which as a bonus could increase your property value.'
                ]
            ],
            [
                'question' => 'Will windows reduce noise?',
                'answer' => [
                    'If you can hear noise outside your windows are mostly likely old or are failing and it\'s a good time to make the decision to replace your windows. By installing new uPVC windows you could achieve a significant noise reduction, which can be a key decision when buying new double or triple glazing windows for your home. Noise pollution can be reduced by new energy efficient windows.'
                ]
            ],
            [
                'question' => 'What\'s the difference between double & Triple glazing?',
                'answer' => [
                    'The main reason customers choose triple glazing is for energy efficiency reasons, Triple glazing should make your house warmer! Having three panes of glass and a further two insulated spaces in between, will make it the best at preventing heat escaping your home through your windows. Triple glazing will prevent more noisy from outside traveling into your home, which is great if you live near a main or busy Road. Triple glazing is more expensive than double glazing, by around £300 per window, depending on the size and shape.'
                ]
            ],
            [
                'question' => 'How do I know if I should get new windows or repair them?',
                'answer' => [
                    'Windows will typically last between 15 and 25 years depending on the quality. When windows are Beyond economical repair, you should consider making that commercial decision to replace them sooner, rather than later! The following reasons are typically a indication you should make this investment:  If The Windows are rotten or worn out, High energy bills or having to run your boiler for long period of time in the winter to heat your home, increase in noise from outside, Damp or your room feeling damp, your window / doors struggle to open or close and your windows are leaking.'
                ]
            ],
            [
                'question' => 'Will new Windows add value to my Home?',
                'answer' => [
                    'Yes. Research shows that houses typically increase with double or triple glazing. Your property will stand out by having new windows and doors, which should increase the likeness to sell your propert fast. New windows and Doors will increase the Energy Performance certificate, which is really important as new home owners are looking for energy saving benefits to a property.'
                ]
            ],
            [
                'question' => 'What colours do uPVC windows come in?',
                'answer' => [
                    'Many of us just think of White windows, but their are now some fantastic colours that can have a significant impact on the way a property looks, our team will work with you and give you a choice of colour that might suit your taste and most importantly your property. Please see a list of some of our most popular colours,',
                    '<ul><li>Agate Grey.</li><li>Anthracite Grey.</li><li>Black Ash.</li><li>Chartwell Green.</li><li>Cream.</li><li>Golden Oak.</li><li>Grey Aluminium.</li><li>Ice Cream.</li><li>Nut Tree.</li></ul>'
                ]
            ],
        ];

    }

}
