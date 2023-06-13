<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Models\Employees\EmployeeMast;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    public function __construct(){
        
    	$this->middleware('auth');
    }

    public function index(){

        $user = Auth::id();

    	$info = EmployeeMast::where('user_id', Auth::id())->with('department')->first();

        $infos = EmployeeMast::where('user_id', Auth::id())->get();        

    	return view('information.index', compact('info'));
    }

    public function edit( $id){
    	
    	$info = EmployeeMast::where('user_id', Auth::id())->first();

        //return $info;

    	return view('information.edit', compact('info'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'emp_name'  => 'required',
            'email'     => 'required' ]);


    	if($id == Auth::id()){

    		EmployeeMast::where('user_id', $id)
    			->update([
					'emp_name'      => $request->emp_name,
                    'emp_gender'    => $request->emp_gender, 
					'emp_dob'       => $request->dob,
					'contact'       => $request->contact,
					'email'	        => $request->email,
					'curr_addr'     => $request->address]);

            User::find($id)->update([
                'name' => $request->emp_name,
                'email'=> $request->email
            ]);

    		return redirect()->route('information.index')->with('success', 'Successfully updated.');

    	}else{

    		return view('information.index')->with('failure', 'You are not authorized to do this.');

    	}
    }

    public function updateAvatar(Request $request){

        $this->validate($request,
            ['file_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg'],

            ['file_path.required' => 'You must select an image.',
            'file_path.image' => 'File must be an image.']);

        $user_id = Auth::id();

        if($request->hasFile('file_path')){

            $user = EmployeeMast::where('user_id', $user_id)->first();
            // Storage::delete($user->emp_avatar);

            $dir      = 'public/emp-avatar';
            $file_ext = $request->file('file_path')->extension();
            $filename = $user_id.'_'.time().'_emp_avatar.'.$file_ext;
            $path     = $request->file('file_path')->storeAs($dir, $filename);

            EmployeeMast::where('user_id', $user_id)
            ->update(['emp_avatar' => $path]);

            Session::forget('avatar');
            Session::put('avatar', $path);

        }
        

        return back()->with('success', 'Your avatar has been updated.');
    }

}
