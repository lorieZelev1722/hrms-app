<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\LoginModel;

class AuthController extends Controller
{
    //login page view
    public function login_page_view(Request $request){
        if ($request->session()->has('user')) {
            return redirect()->route('dashboard');
        }

        return view('Login.login');
    }

    public function login_submit(Request $request)
    {
        // Validate the incoming request data
        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Attempt to find the user by username
        $user = LoginModel::where('username', $request->username)->first();
    
        // Check if user exists
        if ($user) {
            // Check the credentials using the checkLoginCredentials method
            $user = $user->checkLoginCredentials($request); // Calling the instance method to check login credentials
            
            // If credentials are valid, do the login
            if ($user) {
                // Store user data in session (login successful)
                $request->session()->put('user', $user);
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully logged in',
                    'redirect' => route('dashboard'),
                ]);
            } else {
                // Invalid password or other login failure
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credentials',
                ], 401);
            }
        } else {
            // User does not exist
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }
    }
    
    

    public function dashboard(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }

        $user = $request->session()->get('user');
        // dd($user);
        return view('index', compact('user'));
    }

    public function logout(Request $request)
    {
       return LoginModel::Logout($request);
    }




}
