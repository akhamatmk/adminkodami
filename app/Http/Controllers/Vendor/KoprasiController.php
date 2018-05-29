<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kodami\Models\Mysql\Koprasi;
use Kodami\Models\Mysql\Product;
use Kodami\Models\Mysql\Province;
use Kodami\Models\Mysql\Regency;
use Kodami\Models\Mysql\Vendor;
use Yajra\DataTables\Facades\DataTables;
use DB;

class KoprasiController extends Controller
{
    public function index()
    {
        return view('vendor.koprasi.index');
    }

    public function getData()
    {
    	DB::statement(DB::raw('set @rownum=0'));
        $model = Vendor::select('vendors.*', DB::raw('@rownum  := @rownum  + 1 AS row'))->whereNotNull('koprasi_id');

        return DataTables::eloquent($model)
        ->addColumn('action', function($data){
            return "<a href='".URL('vendor/intern/'.$data->id.'/edit')."' class='btn btn-primary edit'>Edit</a> <a data-id='".$data->id."' class='btn btn-danger delete'>Delete</a>";
        })        
        ->rawColumns(['action'])
        ->make();
    }

    public function getUnregisteredUser()
    {
    	DB::statement(DB::raw('set @rownum=0'));
        $model = Koprasi::select('koprasi.*', DB::raw('@rownum  := @rownum  + 1 AS row'))
                ->leftJoin('vendors', 'vendors.koprasi_id', '=', 'koprasi.id')
                ->WhereNull('vendors.koprasi_id')
                ->WhereNull('vendors.deleted_at');

        return DataTables::eloquent($model)
        ->addColumn('action', function($data){
            return "<a href='".URL('vendor/koprasi/'.$data->id.'/view')."' class='btn btn-primary edit'>View Detail</a>";
        })
        ->addColumn('image', function($data){
            return "<img src='".$data->image."' width='100px' />";
        })
        ->rawColumns(['action', 'image'])
        ->make();

        return $model;
    }

    public function view($id)
    {
        $data['koprasi'] = Koprasi::with('regency', 'regency.province', 'member_2')->find($id);
        
        if($data['koprasi'])
            return view('vendor.koprasi.view', $data);
        else
            return redirect('/vendor/koprasi');
    }

    public function process($id)
    {
        $data['koprasi'] = Koprasi::with('regency', 'regency.province', 'member_2')->find($id);
        if(! $data['koprasi'])
            return redirect('/vendor/koprasi');

        $data['province'] = province::get();

        $data['regency'] = Regency::find($data['koprasi']->regency_id);
        if(isset($data['regency']->province->id))
            $data['data_regency'] = Regency::where('province_id', $data['regency']->province->id)->get();
        else
            $data['data_regency'] = [];
                
        
        return view('vendor.koprasi.process', $data);            
    }

    public function store_process($id, Request $request)
    {
        $koprasi = Koprasi::with('regency', 'regency.province', 'member_2')->find($id);
        if(! $koprasi)
            return redirect('/vendor/koprasi');

        $count = Vendor::get()->count() + 1;
        $length = strlen($count);
        for ($i=$length; $i < 6; $i++) { 
            $count = "0".$count;
        }
        $code = "V/".date("Ymdhis")."/".date("DM")."/".$count;

        $vendor = new Vendor;
        
        $vendor->code = $code;
        $vendor->name = $request->name;
        $vendor->koprasi_id = $id;
        $vendor->username = $request->username;
        $vendor->password = Hash::make($request->password);
        $vendor->pic = $request->pic_name;
        $vendor->telephone = $request->telephone;
        $vendor->email = $request->email;
        $vendor->regency_id = $request->regency;
        $vendor->detail_address = $request->detail_address;

        $vendor->save();

        Product::where('koprasi_id', $id)->update(['vendor_id' => $vendor->id]);

        return redirect('/vendor/intern');
    }

}
