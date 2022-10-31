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
    private function coreModuleCheck($IDModule){

        $coreModulesList = ['Core Modules', 'Full stack', 'HPC', 'HPT', 'IPC', 'IPT'];
        $Modules = \DB::table('MODULES_LIST')->select(['ID_MODULE', 'MODULE_CAPTION'])->get();
        return $Modules->contains(function ($module, $key) use ($IDModule, $coreModulesList) {
            return ($module->ID_MODULE == $IDModule) && in_array($module->MODULE_CAPTION, $coreModulesList);
        });
        
    }

    public $parsedEngineModels = [];
    public $LLP_ORDER_COUNTER = 0;

    private function getLLPOrder($IDEngineModel){
        global $parsedEngineModels;
        global $LLP_ORDER_COUNTER;
        if(in_array($IDEngineModel, $this->parsedEngineModels)){
            return $this->LLP_ORDER_COUNTER + 10;
        }else{
            $this->parsedEngineModels[] = $IDEngineModel;
            $this->LLP_ORDER_COUNTER = 10;
            return $this->LLP_ORDER_COUNTER;
        }

    }

    public function collection(Collection $collection)
    {
     
        $data = [];

        foreach ($collection as $row) 
        {
            

            

            try{
                $data[] = [

                'ID_EngineModel' => $row['id_engine_model'] ?? Null,
                'ID_EVENT_UNIT' => $row['id_event_unit'] ?? Null,
                'ID_OPERATOR'=> $row['id_operator'] ?? Null,
                'ID_SOURCE' => $row['id_source'] ?? Null,
                'ID_PARTNUMBER' => $row['partnumber'] ?? Null,
                'ID_MODULE' => $row['id_module'] ?? Null,
                'DATAYEAR' => date('d-m-Y', strtotime($row['date_of_source_data'])) ?? Null,
                'LLP_Description'=> $row['llp_description'] ?? Null,
                'LifeLimit_MIN' => $row['min_life_limit'] ?? Null,
                'LifeLimit_MAX' => $row['max_life_limit'] ?? Null,
                'Annual_Escalation_Rate' => $row['annual_escalation_rate'] ?? Null,
                'LLP_COST_MIN' => $row['llp_min_cost'] ?? Null,
                'LLP_COST_MAX'=> $row['llp_max_cost'] ?? Null,
                'ID_CURRENCY' => $row['id_currency'] ?? Null,
                'Is_Backcasting' => 0,
                'Is_CLP' => 1,
                'LLP_Global_price' => $row['llp_global_price'] ?? Null,
                'Core_Module' => $this->coreModuleCheck($row['id_module']) ? 'TRUE' : 'FALSE',
                'LLP_Order' => $this->getLLPOrder($row['id_engine_model']),
                'CreatedBy' => 'Salah',
                'CreationDate' => now(),
                'ModifiedBy'=> 'Salah',
                'ModificationDate' => now()

                ];

            }
            catch(Exception $e){
                // dd($row, $e);
            }
            
        }

        $data = collect($data);
        $chunks = $data->chunk(100);

        foreach ($chunks as $chunk){
            $table = \DB::table('ENGINE_LLP_MX');
            $table->insert($chunk->toArray());
        }

        // $table = \DB::table('ENGINE_LLP_MX');
        // $table->insert($data);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
