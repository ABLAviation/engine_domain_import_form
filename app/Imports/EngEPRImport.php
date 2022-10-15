<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\EPR;

class EngEPRImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
     
        $data = [];
        foreach ($collection as $row) 
        {
            try{
                $data[] = [

                'ID_EngineModel' => $row['company_name'],
                'ID_SOURCE' => $row['company_catagory'],
                'ID_MODULE'=> $row['company_type'],
                'ID_OPERATOR' => $row['company_address'],
                'ID_EVENT_UNIT' => $row['company_status'],
                'DateOfSourceDATA' => $row['company_catagory'],
                'EPR_COST_MIN'=> $row['company_type'],
                'EPR_COST_MAX' => $row['company_address'],
                'MTBR_MIN' => $row['company_status'],
                'MTBR_MAX' => $row['company_catagory'],
                'MATERIAL_COST_MIN'=> $row['company_type'],
                'MATERIAL_COST_MAX' => $row['company_address'],
                'LABOUR_COST_MIN' => $row['company_status'],
                'LABOUR_COST_MAX' => $row['company_catagory'],
                'ID_CURRENCY'=> $row['company_type'],
                'ID_EngineFactors' => $row['company_address'],
                'Engine_CostperMH' => $row['company_status'],
                'CreatedBy' => 'Salah',
                'CreationDate' => now(),
                'ModifiedBy'=> 'Salah',
                'ModificationDate' => now()

                ];

            }
            catch(Exception $e){
                dd($row, $e);
            }
            
        }
        $table = \DB::table('ENGINE_EPR_MX');
        $table->insert($data);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
