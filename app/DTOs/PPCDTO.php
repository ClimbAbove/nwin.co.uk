<?php

namespace App\DTOs;

use App\DTOs\Abstracts\AbstractDTO;

class PPCDTO extends AbstractDTO
{
    public $isPPC = false;
    public $isBingPPC = false;
    public $isGooglePPC = false;

    public function __construct($bulk_assignments = [])
    {
        parent::__construct($bulk_assignments);

        if(request()->input('gclid') !== null) {
            $this->isPPC = true;
            $this->isGooglePPC = true;
        }
        elseif(request()->input('msclkid') !== null) {
            $this->isPPC = true;
            $this->isBingPPC = true;
        }

    }



}
