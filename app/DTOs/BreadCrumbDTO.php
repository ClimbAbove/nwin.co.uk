<?php

namespace App\DTOs;

use App\DTOs\Abstracts\AbstractDTO;

class BreadCrumbDTO extends AbstractDTO
{
    protected $text;
    protected $url;

    public function setURL($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getURL()
    {
        return $this->url;
    }

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }
}
