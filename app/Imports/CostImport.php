<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\SourceImport;
use App\Imports\EngModImport;
use App\Imports\ModuleImport;
use App\Imports\EngFactImport;
use App\Imports\EngEPRImport;
use App\Imports\EngLLPImport;
use App\Models\User;

class CostImport implements WithMultipleSheets
{

    private $authenticatedUser;
    function __construct() {
        $this->authenticatedUser = \Auth::user();
    }

    public function sheets(): array
    {
        
        return [

            'SOURCES'  => new SourceImport($this->authenticatedUser),
            'ENG-MOD'  => new EngModImport($this->authenticatedUser),
            'MODULES'  => new ModuleImport($this->authenticatedUser),
            'ENG-FACT' => new EngFactImport($this->authenticatedUser),
            'ENG-EPR'  => new EngEPRImport($this->authenticatedUser),
            'ENG-LLP'  => new EngLLPImport($this->authenticatedUser),

        ];
    }



}
