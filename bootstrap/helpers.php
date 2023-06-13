<?php 
use App\Models\Employees\Hod;
use  App\Models\LogActivity;

if (! function_exists('hod_check')) {
    function hod_check($id)
    {
        $hod = Hod::where('user_id', $id)->get();

        return count($hod) !=0 ? true : false;
    }
}

if (!function_exists('add_log_activities')) {
  function add_log_activities($subject,$type = 'agenda') // Array of IDS
  {
      LogActivity::create([
            'subject'     => $subject,
            'url'         => Request::fullUrl(),
            'method'      => Request::method(),
            'ip_address'  => Request::ip(),
            'agent'       => null,
            'user_id'     => auth()->check() ? auth()->user()->id : null,
            'name'        => auth()->check() ? auth()->user()->name : null,
            'type'        => $type
      ]);
  }
}



 ?>