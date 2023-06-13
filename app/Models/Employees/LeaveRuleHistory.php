<?php

namespace App\Models\Employees;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRuleHistory extends Model
{
    use SoftDeletes;

    protected $table = 'hrms_leaverule_history';

    protected $guarded = [];


}
