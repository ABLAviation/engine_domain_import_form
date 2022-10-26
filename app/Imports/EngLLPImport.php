<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\LLP;

class EngLLPImport implements ToCollection, WithHeadingRow
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
                'ID_EVENT_UNIT' => $row['id_event_unit'],
                'ID_OPERATOR'=> $row['id_operator'],
                'ID_SOURCE' => $row['id_source'],
                'ID_PARTNUMBER' => $row['compapartnumberny_status'],
                'ID_MODULE' => $row['id_module'],
                'DATAYEAR' => $row['date_of_source_data'],
                'LLP_Description'=> $row['llp_description'],
                'LifeLimit_MIN' => $row['min_life_limit'],
                'LifeLimit_MAX' => $row['max_life_limit'],
                'Annual_Escalation_Rate' => $row['annual_escalation_rate'],
                'LLP_COST_MIN' => $row['llp_min_cost'],
                'LLP_COST_MAX'=> $row['llp_max_cost'],
                'ID_CURRENCY' => $row['id_currency'],
                'Is_Backcasting' => 0,
                'Is_CLP' => 1,
                'LLP_Global_price' => $row['llp_global_price'],
                'Core_Module' => 'TO BE CALCULATED',
                'LLP_Order' => 'TO BE CALCULATED',
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
        $table = \DB::table('ENGINE_LLP_MX');
        $table->insert($data);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
