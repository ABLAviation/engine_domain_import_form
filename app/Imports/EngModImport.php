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
    public function collection(Collection $collection)
    {
        

        $data = [];
        foreach ($collection as $row) 
        {

            try{

                                  
                //Data Arry
                $data[] = [

                'ID_ENGINE_SERIES' => $row['id_engine_serie'],
                'ID_ESN' => $row['id_esn'],
                'MODEL_CAPTION'=> $row['model_caption'],
                'ENGINE_VARIANT' => $row['engine_variant'],
                'CreatedBy' => 'Manal',
                'CreationDate' => now(),
                'ModifiedBy'=> 'Manal',
                'ModificationDate' => now()

                ];



            }
            catch(Exception $e){

                dd($row, $e);

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
