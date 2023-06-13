@extends('layouts.master')
@push('styles')
  <script src="{{asset('themes/vali/js/plugins/bootstrap-datepicker.min.js')}}"></script>
@endpush
@section('content')
<main class="app-content">
	<div style=" padding: 1.5rem; border: 1px solid white;background: white">
		<h1 style="font-size: 24px">Add Employees
			<a href="{{ route('rules.index') }}" class="btn btn-sm btn-primary pull-right"  style="{background-color: #e7e7e7; color: black;}" >Back</a>
		</h1><hr>
		<div>
			@if($message = Session::get('success'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{$message}}
              </div>
            @endif
	    </div>
		<form action="{{route('rules.employees.store')}}" method="POST" >
			@csrf
			<h5>Employee Detail</h5><br>
			<div class="row col-12">
				<div class="col-6 form-group">
					<label for="">Employee Name</label>
					<select name="employees" class="form-control" id="select2">
						<option value=""></option>
						@foreach($employees as $index)
							<option value="{{$index->user_id}}" {{$index->update_leaverule == 0 ? '' : 'disabled'}} >{{strtoupper($index->emp_code)}} : {{strtoupper($index->emp_name)}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-6 form-group">
					<label for="emp_code">Employee Code</label>
					<input type="text" class="form-control" name="emp_code" id="emp_code" value="{{old('emp_code')}}" readonly="" >
					@error('emp_code')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			<div class="row"><div class="col-6"><h5>Permissions </h5></div></div>
			<hr>
			<div id="addRow">
				<div class="row col-12">
					<div class="col-3 form-group">
						<div class="form-check" style="font-weight: 600;">
						    <input type="checkbox" name="add_employee" class="form-check-input" id="addEmployees" value=1>
						    <b><label class="form-check-label" for="addEmployees">Can add Other employees.</label></b>
						</div>
					</div>
					<div class="col-3 form-group">
						<div class="form-check" style="font-weight: 600;">
						    <input type="checkbox" name="see_empoyees" class="form-check-input" id="seeEmployees" value=1>
						    <label class="form-check-label" for="seeEmployees">Can see who has rights to edit rule.</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 form-group text-center">
				<button class="btn btn-info btn-sm" style="width: 20%">SAVE</button>
			</div>
		</form>
	</div><br>
</main>
<script type="text/javascript">


$(document).ready(function(){

	$('#select2').select2({
		placeholder: "Select employees",
    	allowClear : true,

	});

	$('#select2').on('change', function(){
		
		var user_id = $(this).val();
		var name 	= $("#select2 option:selected").text();
		var code = name.split(' ');

		$('#emp_code').val(code[0]);
	});

    
});
</script>
<style type="text/css">
  .approve
  {
    background: #0cac0c;
    color: white;
  }
  .decline
  {
    background: #ff1414;
    color: white;
  }
 
  .apprv_msg{
    color: #0cac0c;
  }
  .dec_msg{
    color: #ff1414;
  }
  .rev_msg{
    color: #3375ca;
  }

</style>

@endsection
