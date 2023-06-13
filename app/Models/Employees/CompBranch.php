<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompBranch extends Model
{
    //
     use SoftDeletes;
    protected $table = 'hrms_comp_branch';
    protected $guarded = [];

    public function branch(){
    	return $this->belongsTo('App\Models\Master\CompMast', 'comp_id');
    }
}
