<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\SalesAndDistribution;
use Kodami\Models\Mysql\Vendor;
use Kodami\Models\Mysql\KodamiProduct;
use Yajra\DataTables\Facades\DataTables;
use DB;

class SalesAndDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['vendor'] = Vendor::get();
        $data['product'] = KodamiProduct::select('name', 'id', 'name_alias')->where('status', 1)->get();
        return view('sales_and_distribution.index', $data);
    }

    public function getData()
    {
        DB::statement(DB::raw('set @rownum=0'));        
        $model = SalesAndDistribution::select('sales_and_distributions.*', DB::raw('@rownum  := @rownum  + 1 AS row'));

        return DataTables::eloquent($model)
        ->addColumn('action', function($data){
            return "<a type='button' data-id='".$data->id."' class='btn btn-primary edit'>Edit</a> <a type='button' data-id='".$data->id."' class='btn btn-danger delete'>Delete</a>";
        })
        ->addColumn('price', function($data){
            return number_format($data->price);
        })
        ->addColumn('product_name', function($data){
                if(isset($data->kodami_product))
                    return $data->kodami_product->name;
                else
                    return "-";
        })
        ->addColumn('vendor_name', function($data){
                if(isset($data->vendor))
                    return $data->vendor->name;
                else
                    return "-";
        })
        ->rawColumns(['action'])
        ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['vendor'] = Vendor::get();
        $data['product'] = KodamiProduct::select('name', 'id', 'name_alias')->where('status', 1)->get();

        return view('sales_and_distribution.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $Sales = $request->Sales;
        foreach ($Sales as $key => $value) {
            $SalesAndDistribution = new SalesAndDistribution;
            $SalesAndDistribution->kodami_product_id = (int) $value["product_id"];
            $SalesAndDistribution->vendor_id = (int) $value["vendor_id"];
            $SalesAndDistribution->price = (int) str_replace(",", "", $value["price"]);
            $SalesAndDistribution->valid_date = date("Y-m-d", strtotime($value["valid_until"]));
            $SalesAndDistribution->min_order = (int) $value["min_order"];

            $SalesAndDistribution->save();
        
        }

        return redirect('/salesAndDistribution');
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
        $SalesAndDistribution = salesAndDistribution::find($id);
        return $SalesAndDistribution;
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
        $SalesAndDistribution = salesAndDistribution::find($id);
        $SalesAndDistribution->kodami_product_id = (int) $request->kodami_product_id;
        $SalesAndDistribution->vendor_id = (int) $request->vendor_id;
        $SalesAndDistribution->price = (int) str_replace(",", "", $request->price);
        $SalesAndDistribution->valid_date = date("Y-m-d", strtotime($request->valid_until));
        $SalesAndDistribution->min_order = (int) $request->min_order;
        $SalesAndDistribution->save();

        return $SalesAndDistribution;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SalesAndDistribution = salesAndDistribution::find($id);
        if($SalesAndDistribution)
            $SalesAndDistribution->delete();
        return 1;
    }
}
