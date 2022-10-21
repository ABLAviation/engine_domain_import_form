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

                $ID_ENGMOD = \DB::table('ENGINE_MODEL')->select('ID_ENGINE_MODEL')
                                                       ->where('ESN_Description','like', $row['esn'])
                                                       ->first()->ID_ESN;

                $data[] = [

                'Module_Caption' => $row['module_caption'],
                'Commercial_Name' => $row['commercial_name'],
                'EngineModel_ID'=> $ID_ENGMOD,
                'ModuleSplit_percentage_overhaulEngine' => $row['moduleSplit_percentage_overhaul_engine'],
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
        $table = \DB::table('MODULES_LIST');
        $table->insert($data);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
