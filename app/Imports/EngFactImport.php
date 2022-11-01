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
                if($row['engine_run'] != ""){
                    $engineRun = ($row['engine_run'] == 'First run') ? 1 : 2 ; 
                }else{
                    $engineRun = Null;
                }

                $data[] = [

                'ID_ENGINE_MODEL' => $row['id_engine_model'] ?? null,
                'ID_ENGINE_RUN' => $engineRun,
                'DateOfSourceDATA'=> date('d-m-Y', strtotime($row['date_of_source_data'])) ?? null,
                'DERATE' => $row['derate'] ?? null,
                'UTILIZATION_FH' => $row['utilisation_fh'] ?? null,
                'FC_FH_RATIO' => $row['fcfh_ratio'] ?? null,
                'SVR' => $row['svr'] ?? null,
                'EAF' => $row['eaf'] ?? null,
                'Operating_ENV' => $row['operating_environment'] ?? null,
                'SPECIFIC_PERCENTAGE_INCREASE' => $row['specific_percentage_increase'] ?? null,
                'SPECIFIC_THRUST' => $row['specific_thrust'] ?? null,
                'SVC' => $row['svc'] ?? null,
                'TOW' => $row['tow'] ?? null,
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
        $chunks = $data->chunk(100);

        foreach ($chunks as $chunk){
            $table = \DB::table('ENGINE_FACTORS');
            $table->insert($chunk->toArray());
        }

        // $table = \DB::table('ENGINE_FACTORS');
        // $table->insert($data);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
