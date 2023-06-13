@extends('layouts.master')
@push('styles')
  <script src="{{asset('themes/vali/js/plugins/bootstrap-datepicker.min.js')}}"></script>
@endpush
@section('content')
<main class="app-content">
	
	<div style=" padding: 1.5rem; border: 1px solid white;background: white">
		{{-- <div class="col-md-12 col-xl-12"> --}}
			<h1 style="font-size: 24px">Loan Request
				<a href="{{URL::previous() }}" class="btn btn-sm btn-primary pull-right"  style="{background-color: #e7e7e7; color: black;}" >Back</a>
		</h1>
		{{-- </div> --}}
		@if($message = Session::get('success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>
				{{$message}}
			</div>
		@endif
		<div>
	      <h4 style="color: grey">Status - 
	      	@if($request->accountant == 0)
	      		<span style="color: #0cac0c;" id="sanctionSts">SANCTIONED</span>
	      		<span style="color: #3375ca;display: none;" id="disburseSts">DISBURSED</span>
	      			&nbsp&nbsp
	      			@if(!empty($request->disburse_amount))
	      				<button class="btn btn-info btn-sm" id="disburseAmount">DISBURSE</button>
	      			@endif
	      	@elseif($request->accountant == 1)
	      		<span style="color: #3375ca;" >DISBURSED</span>
	      	@endif
	       </h4> 
	    </div>
		{{-- <form action="{{route('loan-request.store')}}" method="POST" >
			@csrf --}}
			<h5>Employee Detail</h5><hr>
			<div class="row">
				<div class="col-6 form-group">
					<label for="">Employee Name</label>
					<input type="text" class="form-control" name="emp_name" value="{{old('emp_name', $emp->emp_name)}}" readonly="">
					
				</div>
				<div class="col-6 form-group">
					<label for="emp_code">Employee Code</label>
					<input type="text" class="form-control" name="emp_code" value="{{old('emp_code', $emp->emp_code)}}" readonly="">
					@error('emp_code')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			<h5>Loan Application Detail</h5><hr>
			<div class="row">
				<div class="col-6 form-group ">
					<label for="">Interest Rate ( % )</label>
					<input type="text" class="form-control" name="interest_rate" value="{{$request->interest_rate}}" readonly="" id="interest_rate">
					@error('interest_rate')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
					@enderror
				</div>	
				<div class="col-6 form-group ">
					<label for="">Loan Types</label>
					<select name="loan_type" class="custom-select form-control select2">
						<option value="">Select Type</option>
							@foreach($types as $type)
								<option value="{{$type->id}}" {{old('loan_type', $request->loan_type_id) == $type->id ? 'selected' : ''}}>{{ucwords($type->name)}}</option>
							@endforeach
					</select>
					@error('loan_type')
		                  <span class="text-danger" role="alert">
		                      <strong>{{ $message }}</strong>
		                  </span>
		              @enderror
				</div>
				<div class="col-6 form-group">
					<label for="">Loan Amount (In INR)</label>
					<input type="text" class="form-control" name="loan_amount" value="{{$request->requested_amount}}" id="loan_amount">
					@error('loan_amount')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="col-6 form-group">
					<label for="monthly_deduction">Monthly Deduction (In INR)</label>
					<input type="text" class="form-control" name="monthly_deduction" value="{{$request->emi}}" readonly="" id="monthly_deduction" >
					@error('monthly_deduction')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
					@enderror
				</div>			
				<div class="col-6 form-group ">
					<label for="">Tenure ( Months )</label>
					<input type="number" class="form-control " name="tenure" value="{{$request->expected_tenure}}" id="tenure" min="1">
					@error('tenure')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="col-6 form-group ">
					<label for="">Total Interest (In INR)</label>
					<input type="text" class="form-control " name="total_interest" value="{{$request->total_interest_expected}}" id="total_interest" min="1" readonly="" id="total_interest">
					@error('total_interest')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
					@enderror
				</div>
				
				@php

					$loan_with_interest = $request->requested_amount + $request->total_interest_expected ;

				@endphp
			</div>
			<div class="row">
				<div class="col-12 form-group">
					<label for="reason">Reason 
						@error('reason')
				          	<span style="color: red">
								| {{ $message }}
							</span>
				      	@enderror</label>
					<textarea  class="form-control" id="reason" name="reason" >{{$request->reason}}</textarea>
				</div>
			
				{{-- <div class="col-12 form-group text-center">
					<button class="btn btn-info btn-sm" style="width: 20%">SAVE</button>
					 <a class="btn btn-danger btn-sm" href="javascript:location.reload()" style="width: 30%">Cancel</a>
				</div> --}}
			</div>
			<form action="{{route('edit.store', $request->id)}}" method="POST" id="form">
				@csrf
				@method('POST')
			<h5>For Accountant Only</h5><hr>
				<div class="row">
					<input type="hidden" name="expected_tenure" value="{{$request->expected_tenure}}">
					<div class="col-6 form-group ">
						<label for="">Disbursed Date</label>
						<input type="text" class="form-control datepicker" name="disburse_date" value="{{old('disburse_date', $request->disburse_date)}}" id="disburse_date" id="disburse_date" autocomplete="off" required="true">
						@error('disburse_date')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-6 form-group ">
						<label for="">Tenure_Ends</label>
						<input type="text" class="form-control datepicker" name="tenure_ends" value="" autocomplete="off">
						@error('tenure_ends')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-6 form-group ">
						<label for="">Disbursed Amount (In INR)</label>
						<input type="text" class="form-control " name="disburse_amt" value="{{old('disburse_amt', $request->disburse_amt)}}" id="disburse_amt"  id="disburse_amt">
						@error('disburse_amt')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-6 form-group ">
						<label for="">Total Amount (In INR)</label>
						<input type="text" class="form-control " name="total_amount_allotted" value="{{old('total_amount_allotted', $request->total_amount_allotted)}}" id="total_amount_allotted"  id="total_amount_allotted">
						@error('total_amount_allotted')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
						@enderror
					</div>
					

				<div class="col-6 form-group">
					<label for="emi_alloted">Alloted EMI (In INR)</label>
					<input type="text" class="form-control" name="emi_alloted" value="{{$request->emi_alloted}}" readonly="" id="emi_alloted" >
					@error('emi_alloted')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
					@enderror
				</div>
				<div class="col-6 form-group ">
					<label for="total_interest_allotted">Total Interest (In INR)</label>
					<input type="text" class="form-control " name="total_interest_allotted" value="{{$request->total_interest_allotted}}" id="total_interest_allotted" min="1" readonly="" id="total_interest_allotted">
					@error('total_interest_allotted')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
					@enderror
				</div>
				</div>
				@if($request->accountant_approval == 0)
				<div class="col-12 form-group text-center">
					<button class="btn btn-info btn-sm" style="width: 20%" id="update">UPDATE</button>
					 <a class="btn btn-danger btn-sm" href="javascript:location.reload()" style="width: 20%" id="cancel">CANCEL</a>
				</div>
				@endif
			</form>
			</div>
			<br>

			
		{{-- </form> --}}
	</div>
</main>

<script type="text/javascript">
	$('.datepicker').datepicker({
		orientation: "bottom",
		format: "mm-dd-yyyy",
		autoclose: true,
		todayHighlight: true
	});

	//Disbursed Amount

	$('#disburseAmount').on('click', function(){

		var request_id = '{{$request->id}}';

		$.ajax({
			type: 'POST',
			url: '/test-disburse/'+request_id,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(res){
				$('#disburseAmount').hide();
				$('#sanctionSts').hide();
				$('#disburseSts').show();
				$('#update').hide();
				$('#cancel').hide();
				$('#form').content().unwrap();
			}
		})
	});

	$("#disburse_amt").bind('keyup mouseup', function () {

    	var interest 	= parseFloat($('#interest_rate').val());
		var loan_amount = parseFloat($('#disburse_amt').val());
		var tenure 		= parseFloat($('#tenure').val());

		var principal_monthly = loan_amount/tenure; //Only Principal Monthly for 1 month 

		var unitInterest	= (loan_amount/100*interest)/tenure; //Just for 1 month

		var total_interest	= (loan_amount/100*interest)/12*tenure; //Interest for 12 Months

		var total_payout	= loan_amount + total_interest;

		var total_emi = total_payout / tenure ;

		$('#total_amount_allotted').val(total_payout.toFixed(2));
		$('#emi_alloted').val(total_emi.toFixed(2));
		$('#total_interest_allotted').val(total_interest.toFixed(2));      
		$('#unit_interest').val(unitInterest.toFixed(2));      
	});

	/*$('#tenure').on('change', function(){

		var interest 	= parseFloat($('#interest_rate').val());
		var loan_amount = parseFloat($('#loan_amount').val());
		var tenure 		= parseFloat($('#tenure').val());

		var total_amount = loan_amount/100*interest + loan_amount;

		var monthly = total_amount/tenure;

		$('#monthly_deduction').val(monthly.toFixed(2));
	});

	$('#loan_amount').on('change', function(){

		var interest 	= parseFloat($('#interest_rate').val());
		var loan_amount	= parseFloat($('#loan_amount').val());

		var total_interest = loan_amount/100*interest;
		
		$('#total_interest').val(total_interest.toFixed(2));
	})*/
</script>

@endsection
