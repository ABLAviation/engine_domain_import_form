<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Source;

class SourceImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
     
        foreach ($collection as $row) 
        {
            try{

            Source::create([

                'Company_Name' => $row['company_name'],
                'Company_Catagory' => $row['company_catagory'],
                'Company_Type'=> $row['company_type'],
                'Company_Address' => $row['company_address'],
                'Company_Status' => $row['company_status'],
                'CreatedBy' => 'Salah',
                'ModifiedBy'=> 'Salah'

            ]);

            
            // $source = new Source;
            
            // $source->Company_Name = $row['company_name'];
            // $source->Company_Catagory = $row['company_catagory'];
            // $source->Company_Type = $row['company_type'];
            // $source->Company_Address = $row['company_address'];
            // $source->Company_Status = $row['company_status'];
            // $source->CreatedBy = 'Salah';
            // $source->ModifiedBy = 'Salah';
            
            // $source->save();
            

            }
            catch(Exception $e){
                dd($row);
            }
            
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
