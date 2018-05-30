<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\KodamiProduct;
use Kodami\Models\Mysql\KodamiProductImage;
use Kodami\Models\Mysql\Category;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
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
            return '<img src="'.$data->primary_image.'" width="100px"  />';
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
        $category = $request->category;
        $category2 = $request->category2;
        $category3 = $request->category3;
        $images = $request->product_images;
        
        $KodamiProduct = new KodamiProduct;

        if($category3 != -1)
            $KodamiProduct->category_id = $category3;
        else if($category3 != -1)
            $KodamiProduct->category_id = $category2;
        else if($category != -1)
            $KodamiProduct->category_id = $category;
        
        $KodamiProduct->name = $request->name;
        $KodamiProduct->name_alias = str_replace(" ", "_", strtolower($request->name));
        $KodamiProduct->description = $request->short_description;
        $KodamiProduct->long_description = $request->long_description;
        $KodamiProduct->primary_image = $request->product_image_primary;
        $KodamiProduct->weight = (int) $request->weight;
        $KodamiProduct->price = (int) 0;
        $KodamiProduct->save();

        $dataImage = [];
        $a = 0;
        foreach ($images as $key => $value) {
            if(isset($value))
            {
                $dataImage[$a] = array(
                    'kodami_product_id' => $KodamiProduct->id,
                    'image'             => $value,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                );
                $a++;
            }
        }

        if(count($dataImage) > 0)
            \DB::table('kodami_product_images')->insert($dataImage);

        return redirect('product');
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
