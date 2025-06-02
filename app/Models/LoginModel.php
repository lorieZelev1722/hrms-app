<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;



class LoginModel extends Authenticatable
{
    use Notifiable;
    protected $table = 'login_credentials';
    protected $fillable = [
        'username','password'
    ];

    protected $hidden = [
        'password'
    ];

    public function checkLoginCredentials($request)
    {
        $tableName = $this->getTable();  // Get the table name dynamically

        // Retrieve user information along with permissions
        $user = DB::table($tableName)
            ->leftJoin('employee_personal_info', $tableName . '.employee_id', '=', 'employee_personal_info.id')
            ->leftJoin('user_role', $tableName . '.user_role_id', '=', 'user_role.id')
            ->leftJoin('role_permissions', $tableName . '.employee_id', '=', 'role_permissions.user_id')
            ->leftJoin('permission_list', 'role_permissions.permission_id', '=', 'permission_list.id')
            ->where($tableName . '.username', $request->username)
            ->where('role_permissions.status', '=', 1) // Ensure the permission is active
            ->select(
                $tableName . '.id',
                $tableName . '.employee_id',
                $tableName . '.username',
                $tableName . '.password',
                $tableName . '.user_role_id',
                $tableName . '.is_current',
                'employee_personal_info.profile_filename',
                'employee_personal_info.firstname',
                'employee_personal_info.middlename',
                'employee_personal_info.lastname',
                'employee_personal_info.suffix',
                'user_role.user_role',
                'role_permissions.permission_id',
                'permission_list.permission_name',
                'permission_list.route',
                'permission_list.icons',
                'permission_list.module_type',
                'permission_list.internal_link'
            )
            ->get()
            ->groupBy('id')
            ->map(function ($rows) {
                $first = $rows->first();
                $hashedPassword = $first->password;
    
                // Map permissions for the user
                $permissions = $rows->map(function ($row) {
                    return [
                        'id' => $row->permission_id,
                        'name' => $row->permission_name,
                        'route' => $row->route,
                        'icons' => $row->icons,
                        'module' => $row->module_type,
                        'internal_link' => $row->internal_link,
                    ];
                })->filter(function ($item) {
                    return $item['id'] && $item['name'];
                })->unique('id')->values();
    
                // Map module labels
                $module_labels = $rows->map(function ($row) {
                    return [
                        'module' => $row->module_type,
                    ];
                })->filter(function ($item) {
                    return !empty($item['module']);
                })->unique('module')->values();
    
                // Return the user data with permissions and module labels
                $user = [
                    'id' => $first->id,
                    'employee_id' => $first->employee_id,
                    'username' => $first->username,
                    'is_current' => $first->is_current,
                    'user_role' => $first->user_role,
                    'user_role_id' => $first->user_role_id,
                    'fullname' => trim("{$first->firstname} {$first->lastname}"),
                    'permissions' => $permissions,
                    'module_labels' => $module_labels,
                ];
    
                // Return the user data along with the hashed password
                return [
                    'user' => $user,
                    'hashed_password' => $hashedPassword,
                ];
            })
            ->first();
    
        // Check if user credentials match the stored password hash
        if ($user && Hash::check($request->password, $user['hashed_password'])) {
            return $user['user']; // Return the user data if credentials are correct
        }
    
        return null; // Return null if credentials are invalid
    }
    

    public static function Logout($request){
        $request->session()->forget('user');
        return redirect()->route('login');
    }


}
