<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function __construct() {
        $this->middleware('auth')
            ->except(['index', 'show']);
        $this->authorizeResource(Car::class, 'car', [
            'except' => ['index', 'show']
        ]);
    }

    function index() {
        $cars = Car::query()->latest()->simplePaginate(10);

        return view('cars.index', [
            "cars" => $cars
        ]);
    }

    function show(Car $car) {
        return view('cars.show', [
            'car' => $car,
        ]);
    }

    public function create() {
        return view('cars.form');
    }

    public function store(CarRequest $request) {
        $car = auth()->user()
            ->cars()
            ->create($request->validatedWithImage());

        return redirect()->route('cars.show', $car);
    }

    function edit(Car $car){
        return view('cars.form', [
            'car' => $car
        ]);
    }

    function update(CarRequest $request, Car $car) {
        $car->update($request->validatedWithImage());
        return redirect()->route('cars.show', $car);
    }

    function destroy(Car $car){
        $car->deleteImage();
        $car->delete();
        return redirect()->route('cars.index');
    }

    function removeImage(Car $car) {
        $this->authorize('update', $car);

        $car->deleteImage();
        $car->update([
            'image' => null
        ]);

        return back();
    }

    function downloadImage(Car $car){
        return Storage::download($car->carImage());
    }
}
