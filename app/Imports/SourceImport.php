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
                $data[] = [

                'Company_Name' => $row['company_name'] ?? null, 
                'Company_Catagory' => $row['company_catagory'] ?? null, 
                'Company_Type'=> $row['company_type'] ?? null, 
                'Company_Address' => $row['company_address'] ?? null, 
                'Company_Status' => $row['company_status'] ?? null, 
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

        $table = \DB::table('SOURCES_LIST');
        $table->insert($data);

        

    }

    public function headingRow(): int
    {
        return 1;
    }
}
