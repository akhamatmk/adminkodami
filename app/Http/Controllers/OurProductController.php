<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\ChoiceOfOurProductFront;
use Kodami\Models\Mysql\KodamiProduct;
use Yajra\DataTables\Facades\DataTables;
use DB;

class OurProductController extends Controller
{
	public function index(Request $request)
    {    	
		return view('our_product.index');
    }

    public function show()
    {
    	DB::statement(DB::raw('set @rownum=0'));        
    	$model = ChoiceOfOurProductFront::select('choice_of_our_product_front.*', DB::raw('@rownum  := @rownum  + 1 AS row'))->with('product');

		return DataTables::eloquent($model)            
            ->addColumn('status', function($data){            	
            	if($data->status == 1)
                    return 'Active';

                return 'Not Active';
            })
            ->addColumn('product_name', function($data){
            	return $data->product ? $data->product->name : "";
            })
            ->addColumn('image', function($data){            	
            	return "<img src='".$data->image."' width='100px'>";
            })
            ->addColumn('action', function($data){            	
            	$temp="<a type='button' href='".URL('our-product/'.$data->id."/edit")."' data-id='".$data->id."' class='btn btn-primary change'>Edit</a>";
            	$temp .="<a style='margin-left : 10px' type='button' data-id='".$data->id."'class='btn btn-danger delete'>Delete</a>";
            	return $temp;
            })
            ->rawColumns(['action', 'image'])
            ->make();
    }

    public function create()
    {
    	$data['product'] = KodamiProduct::where('status', 1)->get();
    	return view('our_product.create', $data);
    }

    public function edit($id)
    {
    	$data['our'] = ChoiceOfOurProductFront::find($id);
    	if(! $data)
    		return redirect('our-product');

    	$data['product'] = KodamiProduct::where('status', 1)->get();
    	return view('our_product.edit', $data);
    }

    public function store(Request $request)
    {  
        $status = $request->active ? (int) $request->active : 0;

    	$data = new ChoiceOfOurProductFront;
    	$data->kodami_product_id = (int) $request->product;
        $data->image = $request->image;
    	$data->status = $status;
    	$data->save();

    	return redirect('our-product');
    }

    public function put($id, Request $request)
    {
        $status = $request->active ? (int) $request->active : 0;

        $data = ChoiceOfOurProductFront::find($id);
        $data->kodami_product_id = (int) $request->product;
        $data->image = $request->image ? $request->image : $request->old_image;
        $data->status = $status;
        $data->save();

        return redirect('our-product');
    }

    public function destroy($id)
    {
    	$data = ChoiceOfOurProductFront::find($id);
    	if(! $data)
    		return redirect('our-product');
		
		$data->delete();
		return redirect('our-product');
    }
}