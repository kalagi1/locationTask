<?php 

namespace App\Http\Controllers\Api\Location\Service;

use App\Http\Controllers\Api\Location\Interface\LocationInterface;

class LocationService{

    private $repository;

    public function __construct(LocationInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllLocations(){
        return $this->repository->getAllLocations();
    }

    public function addLocation(){
        return $this->repository->addLocation();
    }

    public function getLocationById($id){
        return $this->repository->getLocationById($id);
    }

    public function updateLocationById($id){
        return $this->repository->updateLocationById($id);
    }

    public function deleteLocationById($id){
        return $this->repository->deleteLocationById($id);
    }

    public function rotates($latitude,$longitude){
        return $this->repository->rotates($latitude,$longitude);
    }
}