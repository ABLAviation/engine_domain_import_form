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

                'ID_EngineModel' => $row['id_engine_model'],
                'ID_SOURCE' => $row['id_source'],
                'ID_MODULE'=> $row['id_module'],
                'ID_OPERATOR' => $row['id_operator'],
                'ID_EVENT_UNIT' => $row['id_event_unit'],
                'DateOfSourceDATA' => $row['date_of_source_data'],
                'EPR_COST_MIN'=> $row['epr_min_cost'],
                'EPR_COST_MAX' => $row['epr_max_cost'],
                'MTBR_MIN' => $row['min_mtbr'],
                'MTBR_MAX' => $row['max_mtbr'],
                'MATERIAL_COST_MIN'=> $row['material_min_cost'],
                'MATERIAL_COST_MAX' => $row['material_max_cost'],
                'LABOUR_COST_MIN' => $row['labour_min_cost'],
                'LABOUR_COST_MAX' => $row['labour_max_cost'],
                'ID_CURRENCY'=> $row['id_currency'],
                'ID_EngineFactors' => $row['id_engine_factors'],
                'Engine_CostperMH' => $row['engine_cost_per_mh'],
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
