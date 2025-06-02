<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\CheckUserPermission;
use Illuminate\Http\Request;

Route::get('/', function () {
        return redirect()->route('login');
    });

//components routes
Route::get('/loader',function(){
        return view('Public_Components.loader');
});


//components routes
Route::get('/login_form_view',function(){
        return view('Login.Login_Components.login_form');
});

Route::get('/dashboard_view',function(Request $request){
        if (!$request->session()->has('user')) {
                return redirect()->route('login');
            }
    
        $user = $request->session()->get('user');

       switch($user['user_role_id']){
        case '1':
                return view('Dashboard.admin');
        break;
        case '2':
                return view('Dashboard.hr');
        break;
        case '3':
                return view('Dashboard.employee');
        break;
        default:
                dd('Unknown user please check and ask the admin');
        
       }

 });

 //helper route links


//Routes route links
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login_page_view'])->name('login');
Route::post('/login_submit', [App\Http\Controllers\AuthController::class, 'login_submit'])->name('login_submit');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('check.permission:Dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/employee/employee_list', [EmployeeController::class, 'employee_list'])->name('employee_list')->middleware('check.permission:Employee List');
Route::get('/employee_view_content',[EmployeeController::class,'employee_view_content'])->name('employee_content')->middleware('check.permission:Employee List');
Route::get('/employee_list_data',[EmployeeController::class,'employee_list_data'])->name('employee_data')->middleware('check.permission:Employee List');
Route::get('/employee/add_employee',[EmployeeController::class,'new_employee_page'])->name('new_employee_page')->middleware('check.permission:Add Employee');
Route::get('/new_employee_content',[EmployeeController::class,'new_employee_basic_infos_content'])->name('new_employee_content')->middleware('check.permission:Add Employee');
Route::get('/new_employee_content_p2',[EmployeeController::class,'new_employee_goverment_benefits_content'])->name('new_employee_content_p2')->middleware('check.permission:Add Employee');
Route::post('/save_personal_info',[EmployeeController::class,'storePersonalInfo'])->name('save_personal_info')->middleware('check.permission:Add Employee');
Route::post('/save_contact_info',[EmployeeController::class,'storeContactInfo'])->name('save_contact_info')->middleware('check.permission:Add Employee');
Route::post('/save_address_info',[EmployeeController::class,'storeAddressInfo'])->name('save_address_info')->middleware('check.permission:Add Employee');

//Routes for error
Route::get('/403', function () {
        return view('errors.403'); 
    })->name('error.403');
    


