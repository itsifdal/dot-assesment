<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Providers\StoreDataRajaOngkirService;

class RajaOngkirController extends Controller
{
    protected $storeDataRajaOngkirService;

    public function __construct(StoreDataRajaOngkirService $storeDataRajaOngkirService)
    {
        $this->storeDataRajaOngkirService = $storeDataRajaOngkirService;
    }

    public function getProvinces(Request $request)
    {
        $id = $request->input('id', null);

        if ($id) {
            $province = Province::where('province_id', $id)->get();
            return response()->json($province);
        }

        //local data from database 
        return response()->json([
            'success' => true,
            'message' => 'Local data fetched successfully',
            'data' => Province::select('province_id','province')->get()
        ], 200);
    }

    public function getCities(Request $request)
    {
        $id = $request->input('id', null);

        if ($id) {
            $city = City::where('city_id', $id)->get();
            return response()->json($city);
        }

        return response()->json([
            'success' => true,
            'message' => 'Local data fetched successfully',
            'data' => City::select('city_id','city')->get()
        ], 200);
    }
}