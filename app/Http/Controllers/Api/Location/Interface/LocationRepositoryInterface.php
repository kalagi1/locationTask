<?php 

namespace App\Http\Controllers\Api\Location\Interface;

interface LocationRepositoryInterface {
    public function getAllLocations();
    public function addLocation(string $name , float $latitude , float $longitude , string $hexColor);
    public function getLocationById(int $id);
    public function updateLocationById(int $id , string $name , float $latitude , float $longitude , string $hexColor);
    public function deleteLocationById(int $id);
    public function rotates(float $latitude, float $longitude);
}