@extends('layouts.master')
@section('content')
<main class="app-content">
	<div class="row">
    <div class="col-md-12 col-xl-12">
      <div class="card shadow-xs">

        <div class="col-md-12 col-xl-12" style="margin-top: 15px"> 
          <h1 style="font-size: 24px">Rules
           <!-- @if(Auth::id() == 2 || 1 == 1)
              <span class="ml-2">
                <a href="{{route('rules.employees')}}" class="btn btn-sm btn-success" style="font-size: 13px">
              <span class="fa fa-plus "></span> Add</a>
              </span>
            @endif -->
            <hr>
          </h1>
        </div>
        <div class="card-body table-responsive">
          @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
                {{$message}}
            </div>
          @endif
          <form action="{{route('rules.activate')}}" method="post">
          @csrf
          <div class="row">
            <div class="col-6 form-group">
              <label for="name"><b>Enable/Disable Condition for Applying Leave Here.</b> </label>
              <div class="col-6 form-group">
                <div class="input-group">
                  <div class="input-group-prepend mt-1">
                    <div class="animated-radio-button">
                      <label>
                        <input type="radio" value="1" name="leavestatus" class="mt-1 mr-1"  {{$leaves->status == 1 ? 'checked' : ''}} ><span class="label-text">Enable</span>
                      </label>
                      <label class="ml-3">
                        <input type="radio" value="0" name="leavestatus" class="mt-1 mr-1 ml-3" {{$leaves->status == 0 ? 'checked' : ''}}><span class="label-text">Disable</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 form-group " style="text: center">
            <button class="btn btn-info btn-sm" style="width: 20%">SAVE</button>
          </div><br>
          </form>
          <div>
            <span>Note : If you want to enable 2 days limit for applying leave application, choose ENABLE. If you want to remove 2 days limit for applying leave application, choose DISABLE.</span>
          </div>
        <!-- @if(Auth::id() == 65)
          <table class="table table-striped table-hover" id="UsersTable">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th><b>EMPLOYEE</b></th>
                <th><b>CAN SEE OTHER EMPLOYEES</b></th>
              </tr>
            </thead>
            <tbody>
              @php $count = 0 ;@endphp
              
            </tbody>
          </table>
          @endif  -->
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript">
$(document).ready(function(){

  $('#RolesTable').dataTable( {
    "ordering":   true,
    order   : [[1, 'asc']],
    "columnDefs": [ 
      { "orderable": false, "targets": 0,  }
    ]
  });

  /*$('.empaction').on('click', function(){

      var user = $(this).data('id');
      var user_id = user.split('_')
      var toggle_val = $(this).val()

      

      $.ajax({
        type: 'POST',
        url: '{{route('rules.employees.store')}}'                       ,
        data: {'user_id': user_id[1]},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(data){
          alert(data)
        }
      });

  })*/
 
});
</script>
@endsection