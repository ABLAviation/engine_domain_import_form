<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\ENGMOD;

class EngModImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        
        // "engine_series" => "test"
        // "esn" => "test"
        // "model_caption" => "test"
        // "engine_variant" => "test"
        $data = [];
        foreach ($collection as $row) 
        {
            try{
                $ID_ESN = \DB::table('ESN_LIST')->select('ID_ESN')
                                                ->where('ESN_Description','=',"".$row['esn']."")
                                                ->get()[0]->ID_ESN;

                // $ID_ENGINE_SERIES = \DB::table('ENGINE_SERIES')->select('ID_ENGINE_SERIES')
                //                                 ->where('ENGINE_FAMILY','=',"".$row['engine_series']."")
                //                                 ->get()[0];
                $data[] = [

                'ID_ENGINE_SERIES' => $row['engine_series'],
                'ID_ESN' => $ID_ESN,
                'MODEL_CAPTION'=> $row['model_caption'],
                'ENGINE_VARIANT' => $row['engine_variant'],
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
        $table = \DB::table('ENGINE_MODEL');
        $table->insert($data);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
