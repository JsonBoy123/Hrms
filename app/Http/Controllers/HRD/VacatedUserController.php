<?php

namespace App\Http\Controllers\HRD;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employees\EmployeeMast;

class VacatedUserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /****APPLICATION REQUEST STATUS****/

    //0 = Pending
    //1 = Approved
    //2 = Declined
    //3 = Reversed
    //4 = Ignore/Neglect

    public function index(){

        $users = User::onlyTrashed()->orderBy('id', 'desc')->get();

        return view('HRD.vacated.vacated-user', compact('users'));
    }

    public function destroy(User $user){

        dd($user->all());
    }
    

}