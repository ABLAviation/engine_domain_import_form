<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


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
                'ID_ENGINE_MODEL' => $row['id_engine_model'],
                'ID_ENGINE_RUN' => $row['engine_run'],
                'DateOfSourceDATA'=> $row['date_of_source_data'],
                'DERATE' => $row['derate'],
                'UTILIZATION_FH' => $row['utilisation_fh'],
                'FC_FH_RATIO' => $row['fcfh_ratio'],
                'SVR' => $row['svr'],
                'EAF' => $row['eaf'],
                'Operating_ENV' => $row['operating_environment'],
                'SPECIFIC_PERCENTAGE_INCREASE' => $row['specific_percentage_increase'],
                'SPECIFIC_THRUST' => $row['specific_thrust'],
                'SVC' => $row['svc'],
                'TOW' => $row['tow'],
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
