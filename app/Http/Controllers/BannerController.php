<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\BannerSlideshow;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    public function index()
    {    	
    	return view('banner.index');
    }

    public function show()
    {
    	$model = BannerSlideshow::query();

		return DataTables::eloquent($model)
            ->addColumn('image_base', function($data){
            	if(isset($data->image)) {
                    return '<img src="'. $data->image . '" class="img-responsive" style="width:100px"/>';
                } else
                    return '-';
            })
            ->addColumn('action', function($data){
            	return "<a type='button' class='btn btn-primary'>Edit</a> <a type='button' class='btn btn-danger'>Delete</a>";
            })
            ->addColumn('status', function($data){
            	return "";
            })
            ->addColumn('name_product', function($data){
            	if(isset($data->product))
            		return $data->product->name;
            	else
            		return "-";
            })
            ->rawColumns(['image_base', 'action'])
            ->make();
    }
}
