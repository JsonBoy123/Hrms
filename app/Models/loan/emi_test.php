<?php

namespace App\Models\loan;

use Illuminate\Database\Eloquent\Model;

class emi_test extends Model
{
    protected $table   = 'emi_details_test';

    protected $guarded = [] ;

    public function loanType(){
    	return $this->belongsTo('App\Models\loan\LoanType');
    }

    public function employee(){
    	return $this->belongsTo('App\Models\Employees\EmployeeMast', 'user_id', 'user_id');
    }
}
