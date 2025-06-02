<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\HelperController;
use App\Models\EmployeeModel;
use App\Models\EmployeeContactInfo;
use App\Models\EmployeeAddressInfo;

class EmployeeController extends Controller
{
    public function employee_list(Request $request){
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }
        $user = $request->session()->get('user');

        return view('index',compact('user'));
    }

    public function employee_view_content(){
        return view('Employees.employee_list');
    }

    public function employee_list_data(){

        $helper = new HelperController();
        $result = $helper->GetDepartmentList();
        $employee_list = EmployeeModel::getAllEmployees();

        $data = [
            'department' => $result,
            'employee_list' => $employee_list
        ];

      
         if($data){
            return response()->json([
                'status' => 'success',
                'data' => $data,
                'message' => 'Data succesfully retrieve',
            ],200);
         }else{
            return response()->json([
                'status' => 'error',
                'data' => $data,
                'message' => 'No Data succesfully retrieve',
            ],404);
         }
        

    }

    public function new_employee_page(Request $request){
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }
        $user = $request->session()->get('user');

        return view('index',compact('user'));
    }

    public function new_employee_basic_infos_content(){
        return view('Employees.Create_New_Employee_View.employee_add_basic_infos');
    }

    public function new_employee_goverment_benefits_content(){
        return view('Employees.Create_New_Employee_View.employee_add_goverment_benefits');
    }

    public function storePersonalInfo(Request $request)
    {
        try {
            $validated = $request->validate([
                'profile_filename' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'firstname' => 'required|string',
                'middlename' => 'nullable|string',
                'lastname' => 'required|string',
                'suffix' => 'nullable|string',
                'gender' => 'required|string',
                'birthdate' => [
                    'required',
                    'date',
                    'before:' . now()->startOfYear()->format('Y-m-d'),
                ],
                'civil_status' => 'required',
                'nationality' => 'required',
                'addedbyID' => 'required|integer|exists:employee_personal_info,id',
            ], [
                'addedbyID.exists' => 'The addedbyID does not match any employee.',
            ]);

             // Handle image upload if present
            if ($request->hasFile('profile_filename')) {
                    $file = $request->file('profile_filename');
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/profile_images', $filename);
                    $validated['profile_filename'] = $filename;
            } 
    
            $employee = EmployeeModel::insertPersonalInfo($validated);
    
            return response()->json([
                'status_code' => 200,
                'message' => 'Employee created successfully!',
                'employee' => $employee
            ]);
    
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'status_code' => 422,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            } catch (\Exception $e) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Something went wrong.',
                    'error' => $e->getMessage()
                ], 500);
            }
    }


public function storeContactInfo(Request $request){
    try {
        $validated = $request->validate([
            'employee_id' => 'required|integer|exists:employee_personal_info,id',
            'mobile_no' => 'required|string',
            'landline_no' => 'nullable|string',
            'email_address' => 'required|email|unique:employee_contact_info,email_address',
            'addedbyID' => 'required|integer|exists:employee_personal_info,id',
        ], [
            'addedbyID.exists' => 'The addedbyID does not match any employee.',
        ]);

        $employee = EmployeeContactInfo::insertContactInfo($validated);

        return response()->json([
            'status_code' => 200,
            'message' => 'Contact Info saved successfully!',
            'employee' => $employee->employee_id,
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status_code' => 422,
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'status_code' => 500,
            'message' => 'Something went wrong.',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function storeAddressInfo(Request $request){
        try {
            $validated = $request->validate([
                'employee_id' => 'required|integer|exists:employee_personal_info,id',
                'country' => 'required|string',
                'province'=> 'required|string',
                'town'=> 'required|string',
                'baranggay' => 'required|string',
                'zipcode' => 'required|string',
                'current_address' => 'required|string',
                'temporary_address' => 'nullable|string',
                'addedbyID' => 'required|integer|exists:employee_personal_info,id',
            ], [
                'addedbyID.exists' => 'The addedbyID does not match any employee.',
            ]);

            
            $employee = EmployeeAddressInfo::insertAddressInfo($validated);
    
            return response()->json([
                'status_code' => 200,
                'message' => 'Address Info save successfully!',
                'employee' => $employee->employee_id,
            ]);
    
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'status_code' => 422,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            } catch (\Exception $e) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Something went wrong.',
                    'error' => $e->getMessage()
                ], 500);
            }
    }
    
}
