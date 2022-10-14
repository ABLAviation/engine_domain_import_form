<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
    protected $table = 'SOURCES_LIST';
    protected $primaryKey = 'ID_SOURCE';
    public $incrementing = false;
    const CREATED_AT = 'CreationDate';
    const UPDATED_AT = 'ModificationDate';
    protected $fillable = [
        'Company_Name',
        'Company_Catagory',
        'Company_Type',
        'Company_Address',
        'Company_Status',
        'CreatedBy',
        'ModifiedBy',
    ];
    protected $guarded = [];
}
