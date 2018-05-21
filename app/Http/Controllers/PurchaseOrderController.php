<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\KodamiProduct;
use Kodami\Models\Mysql\RequestForQoutation;
use Kodami\Models\Mysql\RequestForQuotationProduct;
use Kodami\Models\Mysql\PurchaseOrder;
use Kodami\Models\Mysql\PurchaseOrderProduct;
use Kodami\Models\Mysql\Vendor;
use Yajra\DataTables\Facades\DataTables;
use DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('purchase_order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['rfq'] = RequestForQoutation::get();
        $data['vendor'] = Vendor::get();
        $data['product'] = KodamiProduct::select('name', 'id', 'name_alias')->where('status', 1)->get();
        return view('purchase_order.create', $data);
    }

    public function ajax_rfq_product($id)
    {
        $data = RequestForQuotationProduct::where('request_for_quotation_id', $id)->get();
        return $data;
    }

    public function getData()
    {
        $purchase_type = Config("constanta.purchase_type");
        $currency = Config("constanta.currency");
        $solicitation_type = Config("constanta.solicitation_type");

        DB::statement(DB::raw('set @rownum=0'));        
        $model = PurchaseOrder::select('purchase_orders.*', DB::raw('@rownum  := @rownum  + 1 AS row'));

        return DataTables::eloquent($model)
        ->addColumn('action', function($data){
            return "";
        })
        ->addColumn('rfq', function($data){
            if(isset($data->rfq))
                return $data->rfq->case_id;
            else
                return "";
        })
        ->addColumn('vendor', function($data){
            if(isset($data->vendor))
                return $data->vendor->name;
            else
                return "";
        })
        ->rawColumns(['action'])
        ->make();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = PurchaseOrder::get()->count() + 1;
        $length = strlen($count);

        for ($i=$length; $i < 7; $i++) { 
            $count = "0".$count;
        }

        $po_number = "PO/".date("ymdhis")."/".date('DM')."/".$count;
        
        $PurchaseOrder =  new PurchaseOrder;
        $PurchaseOrder->po_number = $po_number;
        $PurchaseOrder->rfq_id = $request->rfq_id;
        $PurchaseOrder->vendor_id = $request->vendor_id;
        $PurchaseOrder->doc_date = $request->doc_date;
        $PurchaseOrder->email = $request->email;
        $PurchaseOrder->ship_via = $request->ship_via;
        $PurchaseOrder->tax = $request->tax;
        $PurchaseOrder->save();

        foreach ($request->content as $key => $value) {
            $PurchaseOrderProduct = new PurchaseOrderProduct;
            $PurchaseOrderProduct->purchase_order_id = $PurchaseOrder->id;
            $PurchaseOrderProduct->kodami_product_id = $value['product'];
            $PurchaseOrderProduct->qty = $value['qty'];
            $PurchaseOrderProduct->delivery_date = $value['delivery_date'];
            $PurchaseOrderProduct->unit_price = (int) str_replace(",", "", $value["unit_price"]);
            $PurchaseOrderProduct->save();
        }
        
        return redirect('/purchase-order');
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
