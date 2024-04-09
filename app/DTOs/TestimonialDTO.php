<?php

namespace App\DTOs;

use App\DTOs\Abstracts\AbstractDTO;

class TestimonialDTO extends AbstractDTO
{
    protected string $title;
    protected $author;

    protected function setAuthor($value)
    {
        $this->author = $value;
    }

    protected function setCaption($value)
    {
        $this->caption = $value;
    }

    protected function getAuthor()
    {
        return $this->author;
    }

    protected function getCaption()
    {
        return $this->caption;
    }


}
