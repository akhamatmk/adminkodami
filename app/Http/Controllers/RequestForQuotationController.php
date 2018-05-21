<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\KodamiProduct;
use Kodami\Models\Mysql\RequestForQoutation;
use Kodami\Models\Mysql\RequestForQuotationProduct;
use Yajra\DataTables\Facades\DataTables;
use DB;

class RequestForQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('request_for_quotation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['purchase_type'] = Config("constanta.purchase_type");
        $data['currency'] = Config("constanta.currency");
        $data['solicitation_type'] = Config("constanta.solicitation_type");
        $data['product'] = KodamiProduct::select('name', 'id', 'name_alias')->where('status', 1)->get();
        return view('request_for_quotation.add', $data);
    }

    public function getData()
    {
        $purchase_type = Config("constanta.purchase_type");
        $currency = Config("constanta.currency");
        $solicitation_type = Config("constanta.solicitation_type");

        DB::statement(DB::raw('set @rownum=0'));        
        $model = RequestForQoutation::select('request_for_qoutation.*', DB::raw('@rownum  := @rownum  + 1 AS row'));

        return DataTables::eloquent($model)
        ->addColumn('action', function($data){
            return "<a href='requestForQuotation/".$data->id."/edit' type='button'class='btn btn-primary '>Edit</a> <a type='button' data-id='".$data->id."' class='btn btn-danger delete'>Delete</a>";
        })
        ->addColumn('purchase_type', function($data) use($purchase_type){
            if(isset($purchase_type[$data->purchase_type]))
                return $purchase_type[$data->purchase_type];
            else
                return "";
        })
        ->addColumn('solicitation_type', function($data) use($solicitation_type){
            if(isset($solicitation_type[$data->solicitation_type]))
                return $solicitation_type[$data->solicitation_type];
            else
                return "";
        })
        ->addColumn('currency', function($data) use($currency){
            if(isset($currency[$data->currency]))
                return $currency[$data->currency];
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
        $count = RequestForQoutation::get()->count() + 1;
        $length = strlen($count);

        for ($i=$length; $i < 7; $i++) { 
            $count = "0".$count;
        }

        $case_id = "RFQ/".date("ymdhis")."/".date('DM')."/".$count;

        $RequestForQoutation = new RequestForQoutation;
        $RequestForQoutation->case_id = $case_id;
        $RequestForQoutation->purchase_type = $request->purchase_type;
        $RequestForQoutation->document_title = $request->document_title;
        $RequestForQoutation->solicitation_type = $request->solicitation_type;
        $RequestForQoutation->currency = $request->currency;
        $RequestForQoutation->delivery_date = $request->delivery_date;
        $RequestForQoutation->expired_date = $request->expiration_date;
        $RequestForQoutation->detail_delivery_address = $request->detail_delivery_addres;
        $RequestForQoutation->effective_date = $request->effective_date;

        $RequestForQoutation->save();

        foreach ($request->content as $key => $value) {
            $RequestForQuotationProduct = new RequestForQuotationProduct;
            $RequestForQuotationProduct->request_for_quotation_id = $RequestForQoutation->id;
            $RequestForQuotationProduct->kodami_product_id = $value['product'];
            $RequestForQuotationProduct->qty = $value['qty'];

            $RequestForQuotationProduct->save();
        }

        return redirect('/requestForQuotation');
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
        $data['request'] = RequestForQoutation::find($id);
        $data['content'] = RequestForQuotationProduct::where('request_for_quotation_id', $id)->get();
        $data['purchase_type'] = Config("constanta.purchase_type");
        $data['currency'] = Config("constanta.currency");
        $data['solicitation_type'] = Config("constanta.solicitation_type");
        $data['product'] = KodamiProduct::select('name', 'id', 'name_alias')->where('status', 1)->get();
        return view('request_for_quotation.edit', $data);
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
        $RequestForQoutation = RequestForQoutation::find($id);
        $RequestForQoutation->purchase_type = $request->purchase_type;
        $RequestForQoutation->document_title = $request->document_title;
        $RequestForQoutation->solicitation_type = $request->solicitation_type;
        $RequestForQoutation->currency = $request->currency;
        $RequestForQoutation->delivery_date = $request->delivery_date;
        $RequestForQoutation->expired_date = $request->expiration_date;
        $RequestForQoutation->detail_delivery_address = $request->detail_delivery_addres;
        $RequestForQoutation->effective_date = $request->effective_date;

        $RequestForQoutation->save();

        RequestForQuotationProduct::where('request_for_quotation_id', (int) $id)->get()->each->delete();
        foreach ($request->content as $key => $value) {
            $RequestForQuotationProduct = new RequestForQuotationProduct;
            $RequestForQuotationProduct->request_for_quotation_id = $RequestForQoutation->id;
            $RequestForQuotationProduct->kodami_product_id = $value['product'];
            $RequestForQuotationProduct->qty = $value['qty'];

            $RequestForQuotationProduct->save();
        }

        return redirect('/requestForQuotation');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $RequestForQoutation = RequestForQoutation::find($id);

        if($RequestForQoutation)
            $RequestForQoutation->delete();

        return 1;
    }
}
