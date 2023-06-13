<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;

class LeaveRuleEmployees extends Model
{
    protected $table = 'hrms_leaverule_employees';

    protected $guarded = [];

    public function employees(){
    	return $this->belongsTo('App\Models\Employees\EmployeeMast', 'user_id', 'user_id');
    }

}
