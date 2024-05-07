<?php

namespace App\Repositories\Interfaces;

interface ContentRepositoryInterface
{
    public function getConfig();
    public function getAddress();
    public function getHero();
    public function getMasonry();
    public function getFaqs();
    public function getTestimonials();
}
