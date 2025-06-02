<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class UserPermissionListModel extends Model
{
    protected $table_name = 'role_permissions';

    public static function GetUserPermissionList($request){
       // Get the table name statically
    $tableName = (new self)->getTable(); // Create an instance to use getTable() inside static method

    $user = $request->session()->get('user');

    return DB::table('role_permissions')
        ->leftJoin('employee_details', 'role_permissions.user_id', '=', 'employee_details.id')
        ->leftJoin('permission_list', 'role_permissions.permission_id', '=', 'permission_list.id')
        ->where('role_permissions.user_id', $user['employee_id']) 
        ->where('role_permissions.status', 1) 
        ->select(
            'role_permissions.permission_id',
            'permission_list.permission_name'
        )
        ->get();

    }
}
