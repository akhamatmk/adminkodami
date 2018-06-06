<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\AdsHome;
use Kodami\Models\Mysql\KodamiProduct;
use Yajra\DataTables\Facades\DataTables;
use DB;

class AdvertisementController extends Controller
{
	public function index(Request $request)
    {    	
		return view('advertisement.index');
    }

    public function show()
    {
    	DB::statement(DB::raw('set @rownum=0'));        
    	$model = AdsHome::select('ads_homes.*', DB::raw('@rownum  := @rownum  + 1 AS row'))->with('product');

		return DataTables::eloquent($model)            
            ->addColumn('images', function($data){            	
            	return "<img src='".$data->image."' width='300px'>";
            })
            ->addColumn('product_name', function($data){
            	return $data->product ? $data->product->name : "";
            })
            ->addColumn('image', function($data){            	
            	return "<img src='".$data->image."' width='300px'>";
            })
            ->addColumn('action', function($data){            	
            	$temp="<a type='button' href='".URL('advertisement/'.$data->id."/edit")."' data-id='".$data->id."' class='btn btn-primary change'>Edit</a>";
            	$temp .="<a style='margin-left : 10px' type='button' data-id='".$data->id."'class='btn btn-danger delete'>Delete</a>";
            	return $temp;
            })
            ->rawColumns(['action', 'image'])
            ->make();
    }

    public function create()
    {
    	$data['product'] = KodamiProduct::where('status', 1)->get();
    	return view('advertisement.create', $data);
    }

    public function edit($id)
    {
    	$data['ads'] = AdsHome::find($id);
    	if(! $data)
    		return redirect('advertisement');

    	$data['product'] = KodamiProduct::where('status', 1)->get();
    	return view('advertisement.edit', $data);
    }

    public function store(Request $request)
    {
    	$data = new AdsHome;
    	$data->kodami_product_id = (int) $request->product;
    	$data->image = $request->image;
    	$data->save();

    	return redirect('advertisement');
    }

    public function put($id, Request $request)
    {
        $data = AdsHome::find($id);
        $data->kodami_product_id = (int) $request->product;
        $data->image = $request->image ? $request->image : $request->old_image;
        $data->save();

        return redirect('advertisement');
    }

    public function destroy($id)
    {
    	$data = AdsHome::find($id);
    	if(! $data)
    		return redirect('advertisement');
		
		$data->delete();
		return redirect('advertisement');
    }
}