<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class EngModImport implements ToCollection, WithHeadingRow
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

                                  
                //Data Arry
                $data[] = [

                'ID_ENGINE_SERIES' => $row['id_engine_serie'] ?? Null,
                // 'ID_ESN' => $row['id_esn'] ?? Null,
                'MODEL_CAPTION'=> $row['model_caption'] ?? Null,
                'ENGINE_VARIANT' => $row['engine_variant'] ?? Null,
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

        $table = \DB::table('ENGINE_MODEL');
        $table->insert($data);

    }

    public function headingRow(): int
    {
        return 1;
    }
}
