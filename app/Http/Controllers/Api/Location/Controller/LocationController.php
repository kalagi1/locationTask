<?php

namespace App\Http\Controllers\Api\Location\Controller;

use App\Http\Controllers\Api\Location\Request\AddLocationRequest;
use App\Http\Controllers\Api\Location\Request\RotatesRequest;
use App\Http\Controllers\Api\Location\Request\UpdateLocationRequest;
use App\Http\Controllers\Api\Location\Resource\LocationResource;
use App\Http\Controllers\Api\Location\Service\LocationService;
use App\Http\Controllers\Controller;
use Throwable;

class LocationController extends Controller
{
    private $service;

    public function __construct(LocationService $service)
    {
        $this->service = $service;
    }


    public function index(){
        return response()->json(LocationResource::collection($this->service->getAllLocations()), 200);
    }

    public function store(AddLocationRequest $request){
        return response()->json(new LocationResource($this->service->addLocation($request->input('name'),$request->input('latitude'),$request->input('longitude'),$request->input('marker_color_hex'))), 201);
    }

    public function show(int $id){
        return response()->json(new LocationResource($this->service->getLocationById($id)), 201);
    }

    public function update(UpdateLocationRequest $request,int $id){
        $this->service->updateLocationById($id,$request->input('name'),$request->input('latitude'),$request->input('longitude'),$request->input('marker_color_hex'));
        return response()->json("",204);
    }

    public function destroy(int $id){
        $this->service->deleteLocationById($id);
        return response()->json("",204);
    }

    public function rotates(RotatesRequest $request){
        return response()->json(LocationResource::collection($this->service->rotates($request->input('latitude'),$request->input('longitude'))), 200);
    }
}
