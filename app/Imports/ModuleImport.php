<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Module;

class ModuleImport implements ToCollection, WithHeadingRow
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

                'Module_Caption' => $row['module_caption'] ?? Null,
                'Commercial_Name' => $row['commercial_name'] ?? Null,
                'EngineModel_ID'=> $row['id_engine_model'] ?? Null,
                'ModuleSplit_percentage_overhaulEngine' => $row['modulesplit_percentage_overhaul_engine'] ?? Null,
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
        $table = \DB::table('MODULES_LIST');
        $table->insert($data);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
