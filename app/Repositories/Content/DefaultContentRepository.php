<?php

namespace App\Repositories\Content;

class DefaultContentRepository
{
    public function getHero()
    {
        $hero = [];


        $hero['h1'] = 'Conservatories Experts';
        $hero['h2'] = 'Unbeatable Prices, Unbeatable Quality';
        $hero['hero_image'] = '/images/partners/eco-tech-conservatories/hero.png';

        return $hero;
    }

    public function getTestimonials()
    {
        return [];
    }
}
