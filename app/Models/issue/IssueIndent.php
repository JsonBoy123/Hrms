<?php

namespace App\Models\issue;

use Illuminate\Database\Eloquent\Model;

class IssueIndent extends Model
{
    protected $table = 'hrms_issue_indent';
    
    protected $guarded = [];

    public function employee(){
    	return $this->belongsTo('App\Models\Employees\EmployeeMast', 'user_id', 'user_id')->orderBy('emp_name', 'ASC');
    }

    public function department(){
    	return $this->belongsTo('App\Models\Master\DeptMast', 'dept_id');
    }

}
