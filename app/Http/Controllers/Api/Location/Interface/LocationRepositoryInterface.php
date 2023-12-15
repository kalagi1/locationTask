<?php 

namespace App\Http\Controllers\Api\Location\Interface;

interface LocationRepositoryInterface {
    public function getAllLocations();
    public function addLocation();
    public function getLocationById($id);
    public function updateLocationById($id);
    public function deleteLocationById($id);
    public function rotates($latitude,$longitude);
}