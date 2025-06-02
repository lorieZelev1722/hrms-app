<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // Check if 'user' exists in session
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }

        $user = $request->session()->get('user');

        // Check if the user is not an admin
        if ($user['user_role'] !== 'admin' && $user['user_role_id'] !== '1') {
            return redirect('/unauthorized'); // or abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
