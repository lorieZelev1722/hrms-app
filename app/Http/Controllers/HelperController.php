<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\UserAccountTypeModel;
use App\Model\RolePermissionModel;

class HelperController extends Controller
{
    public function getUserAccountTypes(){
        
        $user_role_type = UserAccountTypeModel::select('id','user_role','is_active');

        if($user_role_type){
            return response()->json([
                'user_role_type' => $user_role_type,
                'message' => 'success',
            ],200);
        }
    }

    public function getIndividualRolePermissionByUserRoleID($id){
            $role_permission = RolePermissionModel::select('id','user_role_id','permission_name')
            -> where('user_role_id',$id)
            -> first();

            if($user_role_type){
                return response()->json([
                    'user_permission' => $user_role_type,
                    'message' => 'Success'
                ],200);
            }else{
                return response()->json([
                    'message' => 'This user role id is not found',
                    'status' => 'error'
                ],404);
            }
    }

    public function GetUserRolePermission(){
        $role_permission_list = RolePermissionModel::select('id','user_role_id','permission_name');

        if($role_permission_lis){
            return response()->json([
                'role_permission' => $role_permission_list,
                'message' => 'Success'
            ],200);
        }
    }

    public function GetDepartmentList()
    {
        $data = DB::table('department_list')
            ->leftJoin('employee_personal_info', 'department_list.head_id', '=', 'employee_personal_info.id')
            ->leftJoin('team_info','employee_personal_info.id','=','team_info.employee_id')
            ->where('department_list.is_active', 1)
            ->select(
                'department_list.id',
                'department_list.department_name',
                'department_list.head_id',
                'employee_personal_info.firstname',
                'employee_personal_info.middlename',
                'employee_personal_info.lastname',
                'team_info.id as team_id',
                'team_info.team_name',
            )
            ->get();
    
        // Map department list
        $departmentList = $data->map(function ($row) {
            return [
                'id' => $row->id,
                'name' => $row->department_name,
                'head_id' => $row->head_id,
            ];
        })->unique('id')->values();
    
        // Map head list
        $headList = $data->map(function ($row) {
            return [
                'id' => $row->head_id,
                'name' => trim("{$row->firstname} {$row->middlename} {$row->lastname}"),
                'department_id' => $row->id,
            ];
        })->unique('id')->values();

        $teamList = $data->map(function ($row){
            return [
                'id' => $row->team_id,
                'name' => $row->team_name,
            ];
        })->unique('id')->values();
    
        return [
            'department_list' => $departmentList,
            'head_list' => $headList,
            'team_list' => $teamList
        ];
    }
    

   
}
