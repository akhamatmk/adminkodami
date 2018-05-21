<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\Vendor;
use Yajra\DataTables\Facades\DataTables;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $vendor = new Vendor;

        $vendor->code = $request->code;
        $vendor->name = $request->name;
        $vendor->currency = $request->currency;
        $vendor->email = $request->email;
        $vendor->telephone = $request->telephone;
        $vendor->pic = $request->pic;
        $vendor->save();

        return $vendor;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
