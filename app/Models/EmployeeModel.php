<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EmployeeModel extends Model
{
    protected $table = "employee_personal_info";

    protected $fillable = [
        'profile_filename',
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'gender',
        'birthdate',
        'civil_status',
        'nationality',
        'addedbyID',

    ];

    public static function getAllEmployees()
    {
        $tableName = (new self())->getTable();

        return DB::table($tableName)
            ->leftJoin('employee_work_info', $tableName . '.id', '=', 'employee_work_info.employee_id')
            ->leftJoin('department_list', 'employee_work_info.department_id', '=', 'department_list.id')
            ->where($tableName . '.isCurrent', 1)
            ->select(
                'employee_personal_info.id',
                'employee_personal_info.firstname',
                'employee_personal_info.middlename',
                'employee_personal_info.lastname',
                'employee_personal_info.suffix',
                'employee_work_info.department_id',
                'department_list.department_name'
            )->get();
    }

    public function contactInfo()
    {
        return $this->hasOne(EmployeeContactInfo::class, 'employee_id', 'id');
    }

    public static function insertPersonalInfo(array $data){
            
            return self::create($data);
    }



}
