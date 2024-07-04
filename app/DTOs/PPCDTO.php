<?php

namespace App\DTOs;

use App\DTOs\Abstracts\AbstractDTO;

class PPCDTO extends AbstractDTO
{
    public $isPPC = false;
    public $isBingPPC = false;

    public $isGooglePPC = false;
    public $gclid = null;
    public $msclkid = null;

    public function __construct($bulk_assignments = [])
    {
        parent::__construct($bulk_assignments);


        if(session()->get('_ppc') !== null) {
            $ppc_dto = unserialize(session()->get('_ppc'));
            $this->isPPC = $ppc_dto->isPPC;
            $this->isBingPPC = $ppc_dto->isBingPPC;
            $this->isGooglePPC = $ppc_dto->isGooglePPC;
            $this->gclid = $ppc_dto->gclid;
            $this->msclkid = $ppc_dto->msclkid;
        }

        if(request()->input('gclid') !== null) {
            $this->isPPC = true;
            $this->isGooglePPC = true;
            $this->gclid = request()->input('gclid');
        }
        elseif(request()->input('msclkid') !== null) {
            $this->isPPC = true;
            $this->isBingPPC = true;
            $this->msclkid = request()->input('msclkid');
        }

    }



}
