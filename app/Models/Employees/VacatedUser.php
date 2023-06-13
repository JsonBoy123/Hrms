<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VacatedUser extends Model
{
    use SoftDeletes;

    protected $table = 'users_reset';

    protected $guarded = [];

}
