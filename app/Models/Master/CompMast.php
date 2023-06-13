<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompMast extends Model
{
    use SoftDeletes;
    protected $table = 'hrms_comp_mast'; 
 	
 	public function employees(){
 		return $this->hasMany('App\Models\Employees\EmployeeMast');
 	}
 	public function expense_users(){
      return $this->belongsToMany('App\Models\ExpenseInUser', 'exp_in_user', 'comp_id','emp_id');
  }

    public function expense_permit_users(){
        return $this->belongsToMany('App\Models\ExpensePermitUser', 'exp_permit_user', 'comp_id','emp_id');
    }
}
