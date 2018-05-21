<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\KodamiProduct;
use Kodami\Models\Mysql\Category;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ProductKodamiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product_kodami.index');
    }

    public function getData()
    {
        DB::statement(DB::raw('set @rownum=0'));        
        $model = KodamiProduct::select('kodami_products.*', DB::raw('@rownum  := @rownum  + 1 AS row'));

        return DataTables::eloquent($model)
        ->addColumn('action', function($data){
            return "";
        })
        ->addColumn('price_format', function($data){
            return number_format($data->price);
        })
        ->addColumn('primary_image', function($data){
            return '<img src="'.$data->primary_image.'" width="100px" height="100px" />';
        })
        ->rawColumns(['action', 'primary_image'])
        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = Category::where('active', 1)->where('parent_id', 0)->get();
        return view('product_kodami.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
