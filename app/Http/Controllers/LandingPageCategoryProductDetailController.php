<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\CategoryHome;
use Kodami\Models\Mysql\KodamiProduct;
use Kodami\Models\Mysql\ProductCategoryHome;
use Yajra\DataTables\Facades\DataTables;
use DB;

class LandingPageCategoryProductDetailController extends Controller
{
	public function index($id)
    {
    	$CategoryHome = CategoryHome::find($id);
    	if(! $CategoryHome)
    		return redirect('landing/page/category/product');

    	$temp = [];
    	$ProductCategoryHome = ProductCategoryHome::where('category_home_id', $id)->get();
    	foreach ($ProductCategoryHome as $key => $value) {
    		$temp[] = $value->kodami_product_id;
    	}

    	$KodamiProduct = KodamiProduct::where('status', 1)->get();
		return view('landingPageCategoryProductDetail.index', ['dataCategory' => $CategoryHome, 'KodamiProduct' => $KodamiProduct, 'dataProduct' => $temp]);
    }

    public function show($id)
    {
    	DB::statement(DB::raw('set @rownum=0'));        
        $model = ProductCategoryHome::select('kp.*', DB::raw('@rownum  := @rownum  + 1 AS row'), 'product_category_home.id')
        		->join('kodami_products as kp', 'kp.id', 'product_category_home.kodami_product_id')
        		->where('category_home_id', $id);

        return DataTables::eloquent($model)                       
            ->addColumn('action', function($data){
                $temp="<a style='margin-left : 10px' type='button' data-id='".$data->id."'class='btn btn-warning delete'>Delete</a>";
                return $temp;
            })
            ->addColumn('image', function($data){
                $temp="<img src='".$data->primary_image."' height='100px'>";
                return $temp;
            })
            ->rawColumns(['action', 'image'])
            ->make();
    }

    public function store($id, Request $request)
    {
    	$ProductCategoryHome = ProductCategoryHome::where('category_home_id', $id);
    	$ProductCategoryHome->forceDelete();

    	foreach ($request->value as $key => $value) {
    		$ProductCategoryHome = new ProductCategoryHome;
    		$ProductCategoryHome->kodami_product_id = $value;
    		$ProductCategoryHome->category_home_id = $id;
    		$ProductCategoryHome->save();
    	}

    	return 1;
    }
    public function destroy($id, $id_sub)
    {
    	$ProductCategoryHome = ProductCategoryHome::find($id_sub);
    	$ProductCategoryHome->forceDelete();

    	return redirect('landing/page/category/product/'.$id.'/detail/');
    }
}