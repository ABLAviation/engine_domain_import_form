<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\ENGFACT;

class EngFactImport implements ToCollection, WithHeadingRow
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
                'ID_ENGINE_MODEL' => $row['company_name'],
                'ID_ENGINE_RUN' => $row['company_catagory'],
                'DateOfSourceDATA'=> $row['company_type'],
                'DERATE' => $row['company_address'],
                'UTILIZATION_FH' => $row['company_status'],
                'FC_FH_RATIO' => $row['FC_FH_RATIO'],
                'SVR' => $row['SVR'],
                'EAF' => $row['EAF'],
                'Operating_ENV' => $row['Operating_ENV'],
                'SPECIFIC_PERCENTAGE_INCREASE' => $row['SPECIFIC_PERCENTAGE_INCREASE'],
                'SPECIFIC_THRUST' => $row['SPECIFIC_THRUST'],
                'SVC' => $row['SVC'],
                'TOW' => $row['TOW'],
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
        $table = \DB::table('ENGINE_FACTORS');
        $table->insert($data);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
