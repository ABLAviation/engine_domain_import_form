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

                'Module_Caption' => $row['company_name'],
                'Commercial_Name' => $row['company_catagory'],
                'EngineModel_ID'=> $row['company_type'],
                'ModuleSplit_percentage_overhaulEngine' => $row['company_address'],
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
