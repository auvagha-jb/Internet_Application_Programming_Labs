<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fee;
use App\Student;
use Illuminate\Support\Facades\DB;

class feesController extends Controller
{
	public function create(){
		return view('Jerry/fees');
	}

	public function store(){

		//If the student no exists in the database
		if(Student::where('student_no',request()->input('student_no'))->exists()){
			$fee = request()->validate([
				'student_no' => 'required',
				'amount' => 'required',
				'paid_at' => 'required'
			], [
				'student_no.required' => 'Student Number is required',
				'amount.required' => 'Amount paid is required',
				'paid_at.required' => 'Payment Date is required'
			]);
			$fee = request()->all();
			$fee = Fee::create($fee);
			return back()->with('success', 'Fee payment made successfully');
		}

		return back()->with('success', 'Student does not exist. Ensure you entered the correct student no.');
	}

	public function index(){
		$fees = DB::table('fees')
				->selectRaw('student_no, SUM(amount) AS amount')
				->groupBy('student_no')
				->get();
		
		$total = 0;
		foreach ($fees as $fee) {
			$total = $total + $fee->amount;
		}
					
		return view('Jerry.search')->with('fees', $fees)->with('total', $total);
	}
	

	public function search(Request $request){
		$search = $request->input('search');
		$fees = Fee::where('student_no', 'like', "$search%")->get();
		return view('Jerry.result')->with('fees', $fees);
	}

	public function view($student_no){
        $fee = Fee::find($student_no);
        return view('Jerry.finder')->with('fee', $fee);
    }
 
    public function find(Request $request){
        $search = $request->input('search');
        $fees = Fee::where('student_no', 'like', "$search%")->get();
        return view('Jerry.searchresult')->with('fees', $fees);
    }
}

