<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\Province;
use Kodami\Models\Mysql\Regency;

class PlaceController extends Controller
{
    public function getAjaxRegency(Request $request)
    {
    	$province_id = $request->province_id;
    	$data = Regency::where('province_id', $province_id)->get();
    	return $data;
    }
}
