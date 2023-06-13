<?php

namespace App\Models\loan;

use Illuminate\Database\Eloquent\Model;

class request_test extends Model
{
    protected $table   = 'loan_request_test';

    protected $guarded = [] ;

    public function loanType(){
    	return $this->belongsTo('App\Models\loan\LoanType');
    }

    public function employee(){
    	return $this->belongsTo('App\Models\Employees\EmployeeMast', 'user_id', 'user_id');
    }

    public function disburse_detail(){
    	return $this->belongsTo('App\Models\loan\disburse_test', 'id', 'loan_request_id');	
    }
}
