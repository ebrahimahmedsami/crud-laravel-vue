<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarsResource;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CarsResource
     */
    public function index()
    {
        $cars = Car::paginate(6);
        return new CarsResource($cars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'price' => 'required|gt:0',
            'description' => 'nullable|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        Car::create($validator->validated());
        return response()->json(['status'=>true,'msg'=>'Car Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Car $car
     * @return CarsResource
     */
    public function show(Car $car)
    {
        return new CarsResource(collect($car));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Car  $car
     * @return JsonResponse
     */
    public function update(Request $request, Car $car)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'price' => 'required|gt:0',
            'description' => 'nullable|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $car->update($validator->validated());
        return response()->json(['status'=>true,'msg'=>'Car Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Car  $car
     * @return JsonResponse
     */
    public function destroy(Car $car)
    {
        $car?->delete();
        return response()->json(['status'=>true,'msg'=>'Car Deleted Successfully']);

    }
}
