<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class studentController extends Controller
{
	public function create(){
		return view('Jerry/student');
	}

	public function store(){

		$student = request()->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'student_no' => 'required|unique:students',
			'date_of_birth' => 'required',
			'address' => 'required'

		], [
			'first_name.required' => 'First Name is required',
			'last_name.required' => 'Last Name is required',
			'student_no.required' => 'Student Number is required',
			'date_of_birth.required' => 'Date of Birth is required',
			'address.required' => 'Address is required'
		]);

		$student = request()->all();

		$student = Student::create($student);

		return back()->with('success', 'Student added successfully');
	}
	
	function allStudents()
	{
		$students = Student::all();
		return view('Jerry.allStudents')->with('students', $students);
	}
}
