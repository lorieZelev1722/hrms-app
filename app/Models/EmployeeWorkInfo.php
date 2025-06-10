<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeWorkInfo extends Model
{
    protected $table = "employee_work_info";

    protected $fillable = [
        'employee_id',
        'department_id',
        'employment_type',
        'start_date',
        'status',
        'supervisor_id',
        'team_id',
        'addedbyID'
    ];

    public function workInfo()
    {
        return $this->hasOne(EmployeeWorkInfo::class, 'employee_id', 'id');
    }

    public static function insertWorkInfo(array $data){
            
            return self::create($data);
    }

}
