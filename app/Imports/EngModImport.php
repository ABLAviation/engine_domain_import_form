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
                                                ->where('ESN_Description','like', $row['esn'])
                                                ->first()->ID_ESN;

                $ID_ENGINE_SERIES = \DB::table('ENGINE_SERIES')->select('ID_ENGINE_SERIES')
                                                ->where('ENGINE_FAMILY','like', $row['engine_series'])
                                                ->where('ID_SEVERITY','like', $row['severity'])
                                                ->where('ID_REGION','like', $row['region'])
                                                ->get();


                if(!count($ID_ENGINE_SERIES)){
                    dump(1);
                    $ID_ENGINE_SERIES = \DB::table('ENGINE_SERIES')->select('ID_ENGINE_SERIES')
                    ->where('ENGINE_FAMILY','like', $row['engine_series']);

                    $ID_ENGINE_SERIES = $ID_ENGINE_SERIES
                    ->where(function($query){
                        $query->where(function($query){
                            $query->whereNull('ID_SEVERITY')
                                  ->orWhere('ID_SEVERITY', 'like', '1');
                        })
                            ->orWhere('ID_REGION','like', '1');
                    })

                    ->orderBy('ID_SEVERITY', 'asc')->first()->ID_ENGINE_SERIES;
                }


                                  

                //Data Arry
                $data[] = [

                'ID_ENGINE_SERIES' => $ID_ENGINE_SERIES,
                'ID_ESN' => $ID_ESN,
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
