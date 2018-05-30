<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Kodami\Models\Mysql\KodamiProduct;
use Kodami\Models\Mysql\Category;
use Yajra\DataTables\Facades\DataTables;
use DB;

class UploadController extends Controller
{
	public function imageUpload(Request $request)
    {    	
       	$result_upload = Cloudder::upload($request->file('image')->getPathName());
    	$result = $result_upload->getResult();

    	$result['secure_url'] = str_replace('""', '', $result['secure_url']);
    	return $result['secure_url'];
    }
}