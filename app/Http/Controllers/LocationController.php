<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Province;
use App\Models\City;
use App\Models\Barangay;

class LocationController extends Controller
{
    public function getRegions()
    {
        $regions = Region::select('regCode as region_code', 'regDesc as region_name')->get();
        return response()->json($regions);
    }

    public function getProvinces(Request $request)
    {
        $provinces = Province::select('provCode as province_code', 'provDesc as province_name')
                             ->where('regCode', $request->region_code)
                             ->get();
        return response()->json($provinces);
    }

    public function getCities(Request $request)
    {
        $cities = City::select('citymunCode as citymun_code', 'citymunDesc as citymun_name')
                      ->where('provCode', $request->province_code)
                      ->get();
        return response()->json($cities);
    }

    public function getBarangays(Request $request)
    {
        $barangays = Barangay::select('brgyCode as brgy_code', 'brgyDesc as brgy_name')
                             ->where('citymunCode', $request->citymun_code)
                             ->get();
        return response()->json($barangays);
    }
}
