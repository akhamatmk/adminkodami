<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\KodamiProduct;
use Kodami\Models\Mysql\ProductSpecialOffer;
use Yajra\DataTables\Facades\DataTables;
use DB;

class SpecialOfferProductController extends Controller
{
	public function index(Request $request)
    {    	
		return view('spesial_offer.index');
    }

    public function show(Request $request)
    {
    	DB::statement(DB::raw('set @rownum=0'));        
    	$model = ProductSpecialOffer::select('product_special_offers.*', DB::raw('@rownum  := @rownum  + 1 AS row'))->with('product');

		return DataTables::eloquent($model)            
            ->addColumn('status', function($data){            	
            	if($data->status == 1)
                    return '<a class="btn btn-primary" style="background : #2cabe3">Active</a>';

                return '<a class="btn btn-warning">Not Active</a>';
            })
            ->addColumn('save_money', function($data){            	
            	return number_format($data->save_money);
            })
            ->addColumn('product_name', function($data){
            	return $data->product ? $data->product->name : "";
            })
            ->addColumn('image', function($data){            	
            	return "<img src='".$data->image."' width='100px'>";
            })
            ->addColumn('action', function($data){            	
            	$temp="<a type='button' href='".URL('specialoffer/'.$data->id."/edit")."' data-id='".$data->id."' class='btn btn-primary change'>Edit</a>";
            	$temp .="<a style='margin-left : 10px' type='button' data-id='".$data->id."'class='btn btn-warning delete'>Delete</a>";
            	return $temp;
            })
            ->rawColumns(['action', 'image', 'status', 'long_description'])
            ->make();
    }

    public function create()
    {
    	$data['product'] = KodamiProduct::get();
    	return view('spesial_offer.create', $data);
    }

    public function store(Request $request)
    {
        $data = new ProductSpecialOffer;
        $data->kodami_product_id = (int) $request->product;
        $data->save_money = (int) $request->save_money;
        $data->short_description = $request->short_description;
        $data->long_description = $request->long_description;
        $data->image = $request->image ;
        $data->expired_time = $request->valid_until;
        $data->status = (int) $request->active;
        $data->save();

        return redirect('specialoffer');
    }

    public function edit($id)
    {
        $data['special'] = ProductSpecialOffer::find($id);
        if(! $data['special'])
            return redirect('specialoffer');

        $data['product'] = KodamiProduct::get();
        return view('spesial_offer.edit', $data);
    }

    public function put($id , Request $request)
    {
        $data = ProductSpecialOffer::find($id);
        if(! $data)
            return redirect('specialoffer');

        $data->kodami_product_id = (int) $request->product;
        $data->save_money = (int) $request->save_money;
        $data->short_description = $request->short_description;
        $data->long_description = $request->long_description;
        $data->image = $request->image ? $request->image : $request->old_image;
        $data->expired_time = $request->valid_until;
        $data->status = (int) $request->active;

        $data->save();

        return redirect('specialoffer');
    }

    public function destroy($id)
    {
        $data = ProductSpecialOffer::find($id);
        if(! $data)
            return redirect('specialoffer');

        $data->delete();
        return redirect('specialoffer');        
    }
}