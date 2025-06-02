<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserPermissionListModel;

class CheckUserPermission
{
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }

        $current_permission = UserPermissionListModel::GetUserPermissionList($request);
      
        $hasPermission = collect($current_permission)->contains(function($perm) use ($permission) {
            return $perm->permission_name === $permission;
        });

        // dd($hasPermission);

        if (!$hasPermission) {
            // Redirect to your custom 403 error page
            return redirect()->route('error.403');
        }
        
        
        return $next($request);  // Proceed to the next request or controller
    }
}
