<?php

namespace App\DTOs;

use App\DTOs\Abstracts\AbstractDTO;

class FAQDTO extends AbstractDTO
{
    protected string $question;
    protected $answer;

    protected function setQuestion($value)
    {
        $this->question = $value;
    }

    protected function setAnswer($value)
    {
        $this->answer = $value;
    }

    protected function getQuestion()
    {
       return $this->question;
    }

    protected function getAnswer()
    {
        return $this->answer;
    }

}
