<?php 

namespace App\Http\Controllers\Api\Location\Repository;

use App\Http\Controllers\Api\Location\Interface\LocationInterface;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class LocationRepository implements LocationInterface {
    private $location;

    public function __construct(Location $location)
    {   
        $this->location = $location;
    }

    public function getAllLocations() {
        return $this->location->all();
    }

    public function addLocation(){
        return $this->location->create([
            "name" => request('name'),
            "latitude" => request('latitude'),
            "longitude" => request('longitude'),
            "marker_color_hex" => request('marker_color_hex'),
        ]);
    }

    public function getLocationById($id){
        return $this->location->where('id',$id)->firstOrFail();
    }

    public function updateLocationById($id){
        return $this->getLocationById($id)->update([
            "name" => request('name'),
            "latitude" => request('latitude'),
            "longitude" => request('longitude'),
            "marker_color_hex" => request('marker_color_hex'),
        ]);
    }

    public function deleteLocationById($id){
        return $this->getLocationById($id)->delete();
    }

    public function rotates($latitude,$longitude){
        $nearestLocations = Location::select(
            'id',
            'name',
            'latitude',
            'longitude',
            'marker_color_hex',
            DB::raw(
                '(6371 * acos(cos(radians(' . $latitude . ')) 
                * cos(radians(latitude)) 
                * cos(radians(longitude) - radians(' . $longitude . ')) 
                + sin(radians(' . $latitude . ')) 
                * sin(radians(latitude)))) AS distance')
        )
        ->orderBy('distance')
        ->get();

        return $nearestLocations;
    }
}