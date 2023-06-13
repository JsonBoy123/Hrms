<?php

namespace App\Http\Controllers\loan;

use Auth;
use Illuminate\Http\Request;
use App\Models\Master\LoanType;
use App\Models\loan\LoanRequest;
use App\Models\loan\LoanHistory;
use App\Http\Controllers\Controller;
use App\Models\Employees\EmployeeMast;

use App\Models\loan\request_test;
use App\Models\loan\disburse_test;
use App\Models\loan\emi_test;

class LoanListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexHr()
    {
        $requests = LoanRequest::with(['employee', 'loanType'])
                        ->get();

        return view('loan.listing.index-hr', compact('requests'));
    }

    public function indexSubAdmin()
    {
        $requests = LoanRequest::with(['employee', 'loanType'])
                        ->where('hr_approval', 1)
                        ->get();

        return view('loan.listing.index-subadmin', compact('requests'));
    }

    public function indexAdmin()
    {
        $requests = LoanRequest::with(['employee', 'loanType'])
                        ->where('subadmin_approval', 1)
                        ->where('hr_approval', 1)
                        ->get();

        return view('loan.listing.index-admin', compact('requests'));
    }

    public function indexAccountant()
    {
        $requests = LoanRequest::with(['employee', 'loanType'])
                        ->where('admin_approval', 1)
                        ->where('subadmin_approval', 1)
                        ->where('hr_approval', 1)
                        ->get();

        return view('loan.listing.index-accountant', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = LoanRequest::with(['loanType'])
                        ->where('id', $id)->first();

        return view('loan.listing.show', compact('request'));
    }

    public function HrApproval(Request $request){

        $status = $request->action == 1 ? 1 : 2;

        LoanRequest::where('id', $request->request_id)
            ->update(['hr_approval' => $status]);

        if($status == 1){
            $flag = 1;
        }else{
            $flag = 2;
        }

        return $flag;
    }

    public function SubAdminApproval(Request $request, $request_id){

        $status = $request->action == 1 ? 1 : 2;

        LoanRequest::where('id', $request_id)
            ->update(['subadmin_approval' => $status]);

        if($status == 1){
            $flag = 1;
        }else{
            $flag = 2;
        }

        return $flag;
    }

    public function AdminApproval(Request $request, $request_id){

        $status = $request->action == 1 ? 1 : 2;

        LoanRequest::where('id', $request_id)
            ->update([
                'admin_approval' => $status,
                'sanctioned_date'=> date("m-d-Y")]);

        if($status == 1){
            $flag = 1;
        }else{
            $flag = 2;
        }

        return $flag;
    }

    public function loanDisburse(Request $request, $request_id){

        LoanRequest::where('id', $request_id)
            ->update(['accountant_approval' => 1]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = LoanRequest::where('id', $id)->first();

        $emp     = EmployeeMast::where('user_id', $request->user_id)->first();

        $types   = LoanType::all();


        return view('loan.listing.edit', compact('request', 'emp', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            //'deduction_date' =>  'required',
            //'deduction'       =>  'required',
            'disburse_amt'  =>  'required',
        ]);

        LoanRequest::where('id', $id)
            ->update([
                'disburse_date' =>  $request->disburse_date,
                'account_no'    =>  $request->account,
                'disburse_amt'  =>  $request->disburse_amt,
                'avalable_balance'  => $request->loan_with_interest
            ]);

        return back()->with('success', 'Form has been submitted.');
    }

    /**
     * Show the details of loan request of specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loanMonthlyHistory( $id)
    {
        $request = LoanRequest::where('id', $id)
                        ->with('employee')->first();

        $history = LoanHistory::where('loan_request_id', $id)->get();

        return view('loan.listing.history', compact('request', 'history'));
    }

    public function testListingAcc()
    {
        $requests = request_test::with(['employee', 'loanType'])
                        ->where('hr', 1)
                        ->where('subadmin', 1)
                        ->where('admin', 1)
                        ->get();

        return view('loan.listing.test-acc', compact('requests'));
    }

    public function testEdit($id)
    {
        $request = request_test::where('id', $id)->first();

        $emp     = EmployeeMast::where('user_id', $request->user_id)->first();

        $types   = LoanType::all();


        return view('loan.listing.test-edit', compact('request', 'emp', 'types'));
    }

    public function testEditStore(Request $request, $id){

        request_test::where('id', $id)
            ->update([
            'user_id'                   => Auth::id(),
            'loan_type_id'              => $request->loan_type,
            'disburse_date'             => $request->disburse_date,
            'disburse_amount'           => $request->disburse_amt,
            'tenure_starts'             => $request->disburse_date,
            'tenure_ends'               => $request->tenure_ends,
            'total_amount_allotted'     => $request->total_amount_allotted,
            'emi_alloted'               => $request->emi_alloted,
            'total_interest_allotted'   => $request->total_interest_allotted,
            'remaining_balance'         => $request->total_amount_allotted
            ]);

        disburse_test::create([
            'loan_request_id'   =>  $id,
            'disburse_amount'   =>  $request->disburse_amt,
            'remaining_amount'  =>  $request->total_amount_allotted,
            'tenure_remaining'  =>  $request->expected_tenure,
            'total_interest'    =>  $request->total_interest_allotted,
            'disburse_remain'   =>  $request->disburse_amt,
            'emi_alloted'       =>  $request->emi_alloted
        ]);

        return back()->with('success', 'Form has been submitted.');
    }

    public function testDisburse( $request_id){

        request_test::where('id', $request_id)
            ->update(['accountant' => 1]);
    }

    public function testHr()
    {
        $requests = request_test::with(['employee', 'loanType'])
                        ->get();

        return view('loan.listing.test-hr', compact('requests'));
    }

    public function testHistory( $id)
    {
        $request = request_test::where('id', $id)
                        ->with('employee')->first();

        $history    = emi_test::where('loan_request_id', $id)->get();

        $emi_credit = emi_test::where('loan_request_id', $id)->orderBy('id', 'desc')->first();

        return view('loan.listing.test-history', compact('request', 'history', 'emi_credit'));
    }

    public function testHistoryStore(Request $request, $id)
    {
        $this->validate($request, [
            'deduction_date' =>  'required',
            'deduction'      =>  'required',
            'amount_due'     =>  'required',
        ]);

        $loan_request   = request_test::where('id', $id)->first();

        $disbur_detail  = disburse_test::where('loan_request_id', $id)->where('status', 1)->first();

        $emi            = round($disbur_detail->emi_alloted);

        $deduct         = round($request->deduction);

        $emi_round      = $deduct / $emi;

        $emi_mod        = $deduct % $emi;


        // $next_emi  = round($disbur_detail->next_emi);



        if($emi_mod == 0){
            $a = floor($emi_round);

        }else{
            $a = floor($emi_round)+1;
        }

        for($i=1; $i<=$a; $i++){

            // $deduct   = $deduct - ($i == 1 ? $next_emi : $emi) ;
            $deduct = $deduct - $emi;

            $data[] = [
                'emi_paid' => $deduct < 0 ? ($emi + $deduct) : $emi,
                'remaining_balance' => $deduct < 0 ? abs($deduct) : 0
            ];

            emi_test::create([
                'loan_request_id'   => $id,
                'disburse_detail_id'=> $disbur_detail->id,
                'emi_alloted'       => $loan_request->emi_alloted,
                'emi_paid'          => $data[$i-1]['emi_paid'], 
                'emi_remain'        => $data[$i-1]['remaining_balance'],
                'emi_date'          => $request->deduction_date,
                'submitted_by'      => Auth::id()
            ]);
        }

        $total_emis     = $disbur_detail->paid_amount + $request->deduction;
        $amount_due     = $disbur_detail->remaining_amount - $request->deduction;
        $tenure_left    = $disbur_detail->tenure_remaining - floor($emi_round);

        disburse_test::where('loan_request_id', $id)
            ->where('status', 1)
            ->update([
                'paid_amount'       => $total_emis,
                'remaining_amount'  => $amount_due,
                'tenure_remaining'  => $tenure_left
            ]);

        request_test::where('id', $id)
            ->update([
                'last_emi'          => $request->deduction_date,
                'remaining_balance' => $amount_due
            ]);

        return back()->with('Request has been submitted.');
    }

    public function testDestroyEmi( $id){

        /*$loanhist = emi_test::where('id', $id)->first();

        request_test::where('id', $loanhist->loan_request_id)
            ->increment('avalable_balance', $loanhist->deduction);

        emi_test::where('id', $id)->delete();*/

        return back()->with('success', 'Transaction record has been deleted');
    }

    public function testUpdateEmi( $id){

        

        $request = request_test::where('id', $id)
                        ->with(['disburse_detail' => function($q){
                            $q->where('status', 1);
                        }, 'employee', 'loanType'])->first();

        $types = LoanType::all();

        return view('loan.listing.test-emi-update', compact('request', 'types'));
    }
}