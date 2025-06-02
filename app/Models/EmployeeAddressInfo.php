<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;


class EmployeeAddressInfo extends Model
{
    protected $table = 'employee_address';

    protected $fillable = [
        'employee_id',
        'country',
        'province',
        'town',
        'baranggay',
        'zipcode',
        'current_address',
        'temporary_address',
        'addedbyID'
    ];

    public function personalInfo(){
        return $this->belongsTo(EmployeeModel::class, 'employee_id', 'id');
    }

    public static function insertAddressInfo(array $data){
            
        return self::create($data);
    }
}
