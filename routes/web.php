<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $coordinates = [
        'A' => ['latitude' => 0, 'longitude' => 0],
        'B' => ['latitude' => 5, 'longitude' => 0],
        'C' => ['latitude' => 7, 'longitude' => 0],
        'D' => ['latitude' => -6, 'longitude' => 0],
    ];
    
    $latitudeA = $coordinates['A']['latitude'];
    $longitudeA = $coordinates['A']['longitude'];
    
    $results = [];
    
    foreach ($coordinates as $point => $coords) {
        $latitude = $coords['latitude'];
        $longitude = $coords['longitude'];
    
        $distance = 6371 * acos(
            cos(deg2rad($latitudeA)) * cos(deg2rad($latitude)) * cos(deg2rad($longitude) - deg2rad($longitudeA)) +
            sin(deg2rad($latitudeA)) * sin(deg2rad($latitude))
        );
    
        $results[$point] = $distance;
    }
    
    asort($results);
    
    foreach ($results as $point => $distance) {
        if($point != 'A'){
            echo $point.'<br>';
        }
    }
});
