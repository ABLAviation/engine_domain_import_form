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

                'ID_EngineModel' => $row['company_name'],
                'ID_EVENT_UNIT' => $row['company_catagory'],
                'ID_OPERATOR'=> $row['company_type'],
                'ID_SOURCE' => $row['company_address'],
                'ID_PARTNUMBER' => $row['company_status'],
                'ID_MODULE' => $row['company_name'],
                'DATAYEAR' => $row['company_catagory'],
                'LLP_Description'=> $row['company_type'],
                'LifeLimit_MIN' => $row['company_address'],
                'LifeLimit_MAX' => $row['company_status'],
                'Annual_Escalation_Rate' => $row['company_name'],
                'LLP_COST_MIN' => $row['company_catagory'],
                'LLP_COST_MAX'=> $row['company_type'],
                'ID_CURRENCY' => $row['company_address'],
                'Is_Backcasting' => $row['company_status'],
                'Is_CLP' => $row['company_status'],
                'LLP_Global_price' => $row['company_status'],
                'Core_Module' => $row['company_status'],
                'LLP_Order' => $row['company_status'],
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
