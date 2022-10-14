<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\SourceImport;

class CostImport implements WithMultipleSheets
{
    


    public function sheets(): array
    {
        return [
            'SOURCES' => new SourceImport(),

        ];
    }



}
