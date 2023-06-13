@extends('layouts.master')
@section('content')
<main class="app-content">
	<div style="margin-top: 1.5rem; padding: 1.5rem;" class="tile">
		<h1 style="font-size: 24px">Loan History
			<a href="{{URL::previous() }}" class="btn btn-sm btn-primary pull-right"  style="{background-color: #e7e7e7; color: black;}" >Back</a>
              </h1>
		@if($message = Session::get('success'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{{$message}}
		</div>
		@elseif($message = Session::get('failed'))
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{{$message}}
		</div>
		@endif
		<br>
		<div class="row col-12">
        	<div class="col-6 form-group">
				<b>Name : </b>
				{{ucwords($request['employee']->emp_name)}}
			</div>
			<div class="col-6 form-group">
				<b>Account No. : </b>
				{{ucwords($request->account_no)}}
			</div>
			<div class="col-6 form-group">
				<b>Request Status : </b>
				{{ucwords($request->tenure)}}
			</div>
			<div class="col-6 form-group">
				<b>Loan Type : </b>
				{{ucwords($request['loanType']->name)}}
			</div>
			<div class="col-6 form-group">
				<b>Loan Amount (In INR): </b>
				{{round($request->requested_amt)}}
			</div> 
			<div class="col-6 form-group">
				<b>Interest Rate : </b>
				{{ucwords($request->interest_rate)}}%
			</div>
			<div class="col-6 form-group">
				<b>Tenure (In Month) : </b>
				{{round($request->tenure_allotted)}}
			</div>
			<div class="col-6 form-group">
				<b>Sanctioned date: </b>
				{{ucwords($request->sanction_date)}}
			</div>
			<div class="col-6 form-group">
				<b>Disburse Date : </b>
				{{ucwords($request->disburse_date)}}
			</div>
			<div class="col-6 form-group">
				<b>Disburse Amount (In INR) : </b>
				{{round($request->disburse_amount)}}
			</div>
			<div class="col-6 form-group">
				<b>Monthly Deduction (In INR) : </b>
				{{round($request->emi_alloted)}}
			</div>
			<div class="col-6 form-group">
				<b>Total Interest (In INR) : </b>
				{{round($request->total_interest_allotted)}}
			</div>
			
		</div><br>

		@php $loan_w_interest_amt = $request->disburse_amount + $request->total_interest_allotted ;

			$available_balance = $request->remaining_balance ; @endphp
		@ability('hrms_admin', 'hrms-manage-loan-request')
		<h5>Add Deduction Detail</h5><br>

		<div class="row">
        	<div class="col-12 form-group">
				<h5>Loan Amount w/ Total Interest : {{ round($loan_w_interest_amt) }} Rs.</h5>
				
			</div>
		</div>

		<form action="{{route('test-history.store', $request->id)}}" method="POST">
			@csrf
			@method('POST')
			<div class="row">
				<input type="hidden" name="user_id" value="{{$request->user_id}}">
				
			<h5>Loan Application Detail</h5><hr>
			<div class="row">
				<div class="col-6 form-group">
					<label for="">Loan Amount (In INR)
						@error('loan_amount')
					   		<span style="color: red">| {{ $message }}</span>
						@enderror
					</label>
					<input type="text" class="form-control" name="loan_amount" value="{{old('loan_amount')}}" id="loan_amount">
					
				</div>
				<div class="col-6 form-group ">
					<label for="">Loan Types</label>
					<select name="" class="custom-select form-control select2" id="loanType">
						<option value="" >Select Types</option>
						@foreach($types as $type)
							<option value="" {{$type->id == $request['loanType']->id ? 'selected' : ''}}>{{ucwords($type->name)}}</option>
						@endforeach
					</select>
					
				</div>
				<div class="col-6 form-group ">
					<label for="">Interest Rate ( % )
						@error('interest_rate')
					   		<span style="color: red">| {{ $message }}</span>
						@enderror
					</label>
					<input type="text" class="form-control" name="interest_rate" value="{{$request->tenure_allotted}}" readonly="" id="interest_rate">
					
				</div>	
				<div class="col-6 form-group ">
					<label for="">Tenure Remaining( Months )
						@error('tenure')
					   		<span style="color: red">| {{ $message }}</span>
						@enderror
					</label>
					<input type="number" class="form-control " name="tenure" value="{{$request['disburse_detail']->tenure_remaining}}" id="tenure" min="1">
					
				</div>
				<div class="col-6 form-group ">
					<label for="">Total Interest (In INR)
						@error('total_interest')
					   		<span style="color: red">| {{ $message }}</span>
						@enderror
					</label>
					<input type="text" class="form-control " name="total_interest" value="{{$request['disburse_detail']}}" id="total_interest" min="1" readonly="" id="total_interest">

				</div>
				<div class="col-6 form-group ">
					<label for="">Total Amount with Interest(In INR)
						@error('total_amount')
					   		<span style="color: red">| {{ $message }}</span>
						@enderror
					</label>
					<input type="text" class="form-control " name="total_amount" value="{{old('total_amount')}}" id="total_amount" readonly="" id="total_amount">
				</div>
				<div class="col-6 form-group">
					<label for="monthly_deduction">Monthly Deduction (In INR)
						@error('monthly_deduction')
					   		<span style="color: red">| {{ $message }}</span>
						@enderror
					</label>
					<input type="text" class="form-control" name="monthly_deduction" value="{{old('monthly_deduction')}}" readonly="" id="monthly_deduction" >
				</div>
				<div class="col-12 form-group text-center">
					<button class="btn btn-info btn-sm" style="width: 20%">SAVE</button>
					<a class="btn btn-danger btn-sm" href="javascript:location.reload()" style="width: 20%">CANCEL</a>
				</div>
			</div>
		</form>
		@endability
			{{-- <h5>Deduction Detail</h5><br>
		<hr>

		<table class="table table-striped table-hover table-bordered" id="CandidatesTable">
				<thead class="thead-dark">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Deduction Date</th>
						<th class="text-center">Monthly EMI</th>
						<th class="text-center">Amount Due ( In INR )</th>
						@ability('hrms_admin|hrms_hr', 'Hrms-manage-loan-request')
							<th class="text-center">Actions</th>
						@endability
					</tr>
				</thead>
				@php $count = 0; @endphp
				<tbody id="experiencesTbody">
				@foreach($history as $index)
					<tr class="text-center">
						<td>{{++$count}}</td>
						<td>{{$index->emi_date}}</td>
						<td>{{round($index->emi_paid)}} Rs.</td>
						<td>{{round($index->remaining_balance)}} Rs.</td>
						@ability('hrms_admin|hrms_hr', 'Hrms-manage-loan-request')
						<td>
							<span class="text-center">
								<form action="{{route('test-emi.del', $index->id)}}" method="POST" id="delform_{{ $index->id}}">
										@csrf
										@method('DELETE')
									<a href="javascript:$('#delform_{{$index->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
								</form>
							</span>
						</td>
						@endability
					</tr>
				@endforeach
				</tbody>
		</table> --}}
	</div>
</main>
<script>
$(document).ready(function(){

	

	$(".datepicker").datepicker({
		orientation: "bottom",
		format: "yyyy-mm-dd",
		autoclose: true,
		todayHighlight: true,
	})

	$('#CandidatesTable').DataTable({
		dom: 'Bfrtip',
	  	buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
		]
	});

	$('#deduction').on('change', function(){

		var amount_due	=	'{{$available_balance}}'
		$('#amount_due').val(amount_due) //Reset value when each time user input amount in EMI input field.

		var emi = $(this).val();

		var remaing_amount = amount_due - emi ;

		$('#amount_due').val(remaing_amount)
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
