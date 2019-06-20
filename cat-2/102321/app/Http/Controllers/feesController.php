<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fee;
use Illuminate\Support\Facades\DB;

class feesController extends Controller
{
	public function create(){
		return view('Amos/fees');
	}

	public function store(){

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
	public function index(){

		$fees = DB::table('fees')
				->selectRaw('student_no, SUM(amount) AS amount')
				->groupBy('student_no')
				->get();
		
		$total = 0;
		foreach ($fees as $fee) {
			$total = $total + $fee->amount;
		}
					
		return view('Amos.search')->with('fees', $fees)->with('total', $total);


	}
	

	public function search(Request $request){
		$search = $request->input('search');
		$fees = Fee::where('student_no', 'like', "$search%")->get();
		return view('Amos.result')->with('fees', $fees);
	}
	public function view($student_no){
 
        $fee = Fee::find($student_no);
 
        return view('Amos.finder')->with('fee', $fee);
    }
 
    public function find(Request $request){
        $search = $request->input('search');
 
        $fees = Fee::where('student_no', 'like', "$search%")->get();
 
        return view('Amos.searchresult')->with('fees', $fees);
    }
}

