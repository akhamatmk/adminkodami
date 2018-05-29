<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kodami\Models\Mysql\Product;
use Kodami\Models\Mysql\Province;
use Kodami\Models\Mysql\Regency;
use Kodami\Models\Mysql\Vendor;
use Yajra\DataTables\Facades\DataTables;
use DB;

class InternController extends Controller
{
    public function index()
    {
        return view('vendor.intern.index');
    }

    public function create()
    {
    	$data['province'] = province::get();
    	return view('vendor.intern.create', $data);
    }

    public function store(Request $request)
    {
    	$count = Vendor::get()->count() + 1;
    	$length = strlen($count);
    	for ($i=$length; $i < 6; $i++) { 
    		$count = "0".$count;
    	}

    	$code = "V/".date("Ymdhis")."/".date("DM")."/".$count;

    	$vendor = new Vendor;
    	
    	$vendor->code = $code;
    	$vendor->name = $request->name;
    	$vendor->username = $request->username;
    	$vendor->password = Hash::make($request->password);
    	$vendor->pic = $request->pic_name;
    	$vendor->telephone = $request->telephone;
    	$vendor->email = $request->email;
    	$vendor->regency_id = $request->regency;
    	$vendor->detail_address = $request->detail_address;

		$vendor->save();

		return redirect('/vendor/intern');
    }

    public function getData()
    {
    	DB::statement(DB::raw('set @rownum=0'));
        $model = Vendor::select('vendors.*', DB::raw('@rownum  := @rownum  + 1 AS row'))->whereNull('koprasi_id');

        return DataTables::eloquent($model)
        ->addColumn('action', function($data){
            return "<a href='".URL('vendor/intern/'.$data->id.'/edit')."' class='btn btn-primary edit'>Edit</a> <a data-id='".$data->id."' class='btn btn-danger delete'>Delete</a>";
        })        
        ->rawColumns(['action'])
        ->make();
    }

    public function edit($id)
    {
    	$data['vendor'] = Vendor::find($id);    	

    	if(! $data['vendor'])
    		return redirect('/vendor/intern');

    	$data['regency'] = Regency::find($data['vendor']->regency_id);
    	if(isset($data['regency']->province->id))
    		$data['data_regency'] = Regency::where('province_id', $data['regency']->province->id)->get();
    	else
    		$data['data_regency'] = [];

		$data['province'] = province::get();
    	return view('vendor.intern.edit', $data);
    }

    public function put($id, Request $request)
    {
    	$vendor = Vendor::find($id);
    	
    	$vendor->name = $request->name;
    	$vendor->pic = $request->pic_name;
    	$vendor->telephone = $request->telephone;
    	$vendor->email = $request->email;
    	$vendor->regency_id = $request->regency;
    	$vendor->detail_address = $request->detail_address;

		$vendor->save();

		return redirect('/vendor/intern');
    }

    public function destroy($id)
    {
    	$vendor = Vendor::find($id);
        $vendor->koprasi_id = Null;
        $vendor->save();

    	if($vendor)
    		$vendor->delete();

        Product::where('vendor_id', $id)->update(['vendor_id' => NUll]);

    	return redirect('/vendor/intern');
    }
}
