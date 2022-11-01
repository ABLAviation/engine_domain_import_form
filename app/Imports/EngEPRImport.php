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
    

    private $authenticatedUser;
    function __construct($authenticatedUser) {
        $this->authenticatedUser = $authenticatedUser;
    }


    public function collection(Collection $collection)
    {
     
        $data = [];
        foreach ($collection as $row) 
        {

            
            try{
                $data[] = [

                'ID_EngineModel' => $row['id_engine_model'] ?? Null,
                'ID_SOURCE' => $row['id_source'] ?? Null,
                'ID_MODULE'=> $row['id_module'] ?? Null,
                'ID_OPERATOR' => $row['id_operator'] ?? Null,
                'ID_EVENT_UNIT' => $row['id_event_unit'] ?? Null,
                'DateOfSourceDATA' => date('d-m-Y', strtotime($row['date_of_source_data'])) ?? null,
                'EPR_COST_MIN'=> $row['epr_min_cost'] ?? Null,
                'EPR_COST_MAX' => $row['epr_max_cost'] ?? Null,
                'MTBR_MIN' => $row['min_mtbr'] ?? Null,
                'MTBR_MAX' => $row['max_mtbr'] ?? Null,
                'MATERIAL_COST_MIN'=> $row['material_min_cost'] ?? Null,
                'MATERIAL_COST_MAX' => $row['material_max_cost'] ?? Null,
                'LABOUR_COST_MIN' => $row['labour_min_cost'] ?? Null,
                'LABOUR_COST_MAX' => $row['labour_max_cost'] ?? Null,
                'ID_CURRENCY'=> $row['id_currency'] ?? Null,
                'ID_EngineFactors' => $row['id_engine_factors'] ?? Null,
                'Engine_CostperMH' => $row['engine_cost_per_mh'] ?? Null,
                'CreatedBy' => $this->authenticatedUser->USER_NAME,
                'CreationDate' => now(),
                'ModifiedBy'=> $this->authenticatedUser->USER_NAME,
                'ModificationDate' => now()

                ];

            }
            catch(Exception $e){
                // dd($row, $e);
            }
            
        }

        $data = collect($data);
        $chunks = $data->chunk(50);

        foreach ($chunks as $chunk){
            $table = \DB::table('ENGINE_EPR_MX');
            $table->insert($chunk->toArray());
        }
        // $table = \DB::table('ENGINE_EPR_MX');
        // $table->insert($data);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
