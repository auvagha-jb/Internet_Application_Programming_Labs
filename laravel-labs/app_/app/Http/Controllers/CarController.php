<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function allCars()
    {
        $cars = Car::all();
        return view('cars.allcars')->with('cars', $cars);
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
        $this->validate($request, [
            'make' => 'required',
            'model' => 'required|unique:cars',
            'produced_on' => 'required',
        ],
        [
			'make.required' => 'Make is required',
			'model.required' => 'Model is required',
            'produced_on.required' => 'Student Number is required',
            'model.unique' => 'This model already exists'
        ]);

        $car = new Car;
        $car->make = $request->input('make');
        $car->model = $request->input('model');
        $car->produced_on = $this->formatDate($request->input('produced_on'));
        $car->save();
        return $this->addCar();
    }

    public function addCar()
    {
        return view('cars.addCar');
    }

    public function formatDate($date)
    {
        $date = str_replace('/', '-', $date);
        $new_date = date("Y-m-d", strtotime($date));
        return $new_date;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
