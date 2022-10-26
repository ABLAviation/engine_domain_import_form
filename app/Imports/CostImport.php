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

class CostImport implements WithMultipleSheets
{
    


    public function sheets(): array
    {
        return [

            // 'SOURCES'  => new SourceImport(),
            // 'ENG-MOD'  => new EngModImport(),
            //'MODULES'  => new ModuleImport(),
            // 'ENG-FACT' => new EngFactImport(),
            // 'ENG-EPR'  => new EngEPRImport(),
            'ENG-LLP'  => new EngLLPImport(),

        ];
    }



}
