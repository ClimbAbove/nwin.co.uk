<?php

namespace App\DTOs;

use App\DTOs\Abstracts\AbstractDTO;

class BreadCrumbsDTO extends AbstractDTO
{
    public $breadcrumbs = [];

    public function __construct()
    {
        $home_breadcrumb_dto = new BreadCrumbDTO([
            'text' => 'Home',
            'url' => route('page-home')
        ]);

        $this->pushBreadcrumb($home_breadcrumb_dto);
    }

    public function pushBreadcrumb(BreadCrumbDTO $bread_crumb_dto)
    {
        $this->breadcrumbs[] = $bread_crumb_dto;

        return $this;
    }

    public function getBreadcrumb(BreadCrumbDTO $bread_crumb_dto)
    {
        $this->breadcrumbs[] = $bread_crumb_dto;
    }

    public function getBreadcrumbCount()
    {
        return count($this->breadcrumbs);
    }
}
