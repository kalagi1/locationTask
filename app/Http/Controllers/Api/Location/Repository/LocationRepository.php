<?php 

namespace App\Http\Controllers\Api\Location\Repository;

use App\Http\Controllers\Api\Location\Interface\LocationRepositoryInterface;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class LocationRepository implements LocationRepositoryInterface {
    private $location;

    public function __construct(Location $location)
    {   
        $this->location = $location;
    }

    public function getAllLocations() {
        return $this->location->all();
    }

    public function addLocation(string $name , float $latitude , float $longitude , string $hexColor){
        return $this->location->create([
            "name" => $name,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "marker_color_hex" => $hexColor,
        ]);
    }

    public function getLocationById(int $id){
        return $this->location->where('id',$id)->firstOrFail();
    }

    public function updateLocationById(int $id,string $name , float $latitude , float $longitude , string $hexColor){
        return $this->getLocationById($id)->update([
            "name" => request('name'),
            "latitude" => request('latitude'),
            "longitude" => request('longitude'),
            "marker_color_hex" => request('marker_color_hex'),
        ]);
    }

    public function deleteLocationById(int $id){
        return $this->getLocationById($id)->delete();
    }

    public function rotates(float $latitude, float $longitude){
        $nearestLocations = Location::select(
            'id',
            'name',
            'latitude',
            'longitude',
            'marker_color_hex',
            DB::raw(
                'sqrt(POWER(('.$latitude.' - latitude),2) + POWER(('.$longitude.' - longitude),2)) as distance')
        )
        ->orderBy('distance')
        ->get();
        

        return $nearestLocations;
    }
}