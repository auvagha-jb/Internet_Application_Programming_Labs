<?php

namespace App\Http\Controllers;
use App\Car;

class CarController extends Controller
{
    public function allCars()
    {
        $cars = Car::all();
        return view('cars.allcars')->with('cars', $cars);
    }

    public function particularCar()
    {

    }

    public function newCar()
    {

    }

    public function addCar()
    {
        return view('cars.addCar');
    } 
}