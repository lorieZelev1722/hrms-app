<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class EmployeeContactInfo extends Model
{
    protected $table = 'employee_contact_info';

    protected $fillable = [
        'employee_id',
        'mobile_no',
        'landline_no',
        'email_address',
        'addedbyID'
    ];

    public function personalInfo(){
        return $this->belongsTo(EmployeeModel::class, 'employee_id', 'id');
    }

    public static function insertContactInfo(array $data){
            
        return self::create($data);
}
}
