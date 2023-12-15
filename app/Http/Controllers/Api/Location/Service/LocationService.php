<?php 

namespace App\Http\Controllers\Api\Location\Service;

use App\Http\Controllers\Api\Location\Interface\LocationRepositoryInterface;
use Throwable;

class LocationService{
    private $repository;

    public function __construct(LocationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllLocations(){
        return $this->repository->getAllLocations();
    }

    public function addLocation(string $name , float $latitude , float $longitude , string $hexColor){
        return $this->repository->addLocation($name,$latitude,$longitude,$hexColor);
    }

    public function getLocationById(int $id){
        return $this->repository->getLocationById($id);
    }

    public function updateLocationById(int $id , string $name ,  float $latitude , float $longitude , string $hexColor){
        return $this->repository->updateLocationById($id,$name,$latitude,$longitude,$hexColor);
    }

    public function deleteLocationById(int $id){
        return $this->repository->deleteLocationById($id);
    }

    public function rotates(float $latitude, float $longitude){
        return $this->repository->rotates($latitude,$longitude);
    }
}