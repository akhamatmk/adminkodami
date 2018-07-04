<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\Member_2 as Member;
use Kodami\Models\Mysql\Vendor;
use Kodami\Models\Mysql\Koprasi;
use Kodami\Models\Mysql\Product;
use Kodami\Models\Mysql\Province;
use Kodami\Models\Mysql\Regency;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['province'] = province::get();
        return view('vendor.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $member = new Member;
      $member->email = $request->email;
      $member->username = $request->username;
      $member->name = $request->pic_name;
      $member->phone = $request->telephone ? $request->telephone : 123;
      $member->address = $request->detail_address;
      $member->password = Hash::make($request->password);

      $member->save();

      $koprasi = new Koprasi;
      $koprasi->member_id = $member->id;
      $koprasi->regency_id = $request->regency;
      $koprasi->pickup_address = $request->detail_address;
      $koprasi->postal_code = $request->kode_pos;
      $koprasi->image = $request->image;
      $koprasi->slogan = $request->slogan;
      $koprasi->description = $request->deskripsi;
      $koprasi->name = $request->name;
      $koprasi->url = str_replace(" ", "", $request->name).rand(1, 100);
      $koprasi->save();

      redirect('vendor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        DB::statement(DB::raw('set @rownum=0'));        
        $model = Koprasi::select('koprasi.*', DB::raw('@rownum  := @rownum  + 1 AS row'));

        return DataTables::eloquent($model)            
            ->addColumn('image', function($data){               
                return "<img src='".$data->image."' width='100px'>";
            })
            ->addColumn('action', function($data){              
                return "<a class='btn btn-primary' href='".url('vendor/'.$data->id.'/detail')."'>  Lihat Detail </a>
                        <a style='margin-left : 10px' class='btn btn-primary' href='".url('vendor/'.$data->id.'/product')."'>  Lihat Product Vendor </a>
                        ";
            })
            ->addColumn('regency_name', function($data){
                return $data->regency->name ? (string) $data->regency->name : "";
            })
            ->addColumn('province_name', function($data){
                return $data->regency->province->name ? (string) $data->regency->province->name : "";
            })
            ->addColumn('pic', function($data){
                return $data->member_2->name ? (string) $data->member_2->name : "";
            })
            ->addColumn('phone', function($data){
                return $data->member_2->phone ? (string) $data->member_2->phone : "";
            })
            ->addColumn('email', function($data){
                return $data->member_2->email ? (string) $data->member_2->email : "";
            })
            ->addColumn('verify', function($data){
                if($data->is_verify == 0)
                    $temp = "<button type='button' class='btn' style='background:red; color: white' ><b>Not Approved</b></button>";
                else
                    $temp = "<button type='button' class='btn btn-primary'>Approved</button>";

                return $temp;
            })
            ->rawColumns(['action', 'verify', 'image', 'province_name'])
            ->make();
    }

    public function detail($id)
    {
        $koprasi = Koprasi::find($id);
        if(! $koprasi)
            return redirect('vendor');

        $data['koprasi'] = $koprasi;
        $data['regency'] = Regency::find($koprasi->regency_id);
        if(isset($data['regency']->province->id))
            $data['data_regency'] = Regency::where('province_id', $data['regency']->province->id)->get();
        else
            $data['data_regency'] = [];

        $data['province'] = province::get();

        return view('vendor.detail', $data);
    }

    public function change_status($id)
    {
        $koprasi = Koprasi::find($id);
        if(! $koprasi)
            return redirect('vendor');

        if($koprasi->is_verify == 1)
            $is_verify = 0;
        else
            $is_verify = 1;

        $koprasi->is_verify = $is_verify;

        $koprasi->save();

        Product::where('koprasi_id', $koprasi->id)->update(['is_validate' => 0]);

        return redirect('vendor/'.$koprasi->id.'/detail');
    }

    public function getData()
    {
        $model = Vendor::query();

        return DataTables::eloquent($model)
        ->addColumn('action', function($data){
            return "<a data-id='".$data->id."'  type='button' class='btn btn-primary edit-vendor'>Edit</a> <a type='button' data-id='".$data->id."' class='btn btn-danger delete-vendor'>Delete</a>";
        })
        ->rawColumns(['action'])
        ->make();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
