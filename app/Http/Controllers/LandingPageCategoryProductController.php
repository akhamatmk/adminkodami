<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\CategoryHome;
use Yajra\DataTables\Facades\DataTables;
use DB;

class LandingPageCategoryProductController extends Controller
{
	public function index()
    {    	
		return view('landingPageCategoryProduct.index');
    }

    public function show()
    {
        DB::statement(DB::raw('set @rownum=0'));        
        $model = CategoryHome::select('category_home.*', DB::raw('@rownum  := @rownum  + 1 AS row'));

        return DataTables::eloquent($model)                       
            ->addColumn('action', function($data){
            	$temp = "";
                $temp="<a type='button' data-id='".$data->id."' class='btn btn-primary change'>Edit</a>";
                $temp .="<a style='margin-left : 10px' href='".url('landing/page/category/product/'.$data->id.'/detail')."' type='button' data-id='".$data->id."' class='btn btn-primary'>Lihat Product</a>";
                $temp .="<a style='margin-left : 10px' type='button' data-id='".$data->id."'class='btn btn-warning delete'>Delete</a>";
                return $temp;
            })
            ->rawColumns(['action', 'image', 'status', 'long_description'])
            ->make();
    }

    public function edit ($id)
    {
    	$data = CategoryHome::find($id);
    	return $data;
    }

    public function store(Request $request)
    {
    	if($request->type == 'new')
    		$CategoryHome = new CategoryHome;
    	else{
    		$CategoryHome = CategoryHome::find($request->id);
    		if(! $CategoryHome)
    			return 0;
    	}

    	$CategoryHome->name = $request->name;
    	$CategoryHome->save();
    	return $CategoryHome;
    }
}