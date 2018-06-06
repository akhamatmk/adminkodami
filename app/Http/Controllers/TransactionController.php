<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Kodami\Models\Mysql\Transaction;
use Kodami\Models\Mysql\Category;
use Yajra\DataTables\Facades\DataTables;
use DB;

class TransactionController extends Controller
{
	public function index(Request $request)
    {    	
		return view('transaction.index');
    }

    public function ajax()
    {
    	DB::statement(DB::raw('set @rownum=0'));        
    	$model = Transaction::select('transactions.*', DB::raw('@rownum  := @rownum  + 1 AS row'));

		return DataTables::eloquent($model)
            ->addColumn('price', function($data){
            	return number_format($data->price_product);
            })
            ->addColumn('shipping_fee', function($data){
            	return number_format($data->shipping);
            })
            ->addColumn('adminfee', function($data){
            	return number_format($data->admin_fee);
            })
            ->addColumn('feerandom', function($data){
            	return number_format($data->fee_random);
            })
            ->addColumn('typepayment', function($data){
            	switch ($data->type_payment) {
            		case 1:
            			return "Transfer";
            			break;
            		
            		default:
            				return "Transfer";
            			break;
            	}
            })
            ->addColumn('status', function($data){
            	switch ($data->status) {
            		case 1:
            			return "Menunggu Pembayaran";
            			break;
            		case 2:
            			return "Proses Pengiriman";
            			break;
            		case 3:
            			return "Barang Diterima";
            			break;
            		case 4:
            			return "Transaksi Gagal";
            			break;
            		
            		default:
            				return "Menunggu Pembayaran";
            			break;
            	}
            })
            ->addColumn('total', function($data){
            	$total = $data->price_product + $data->shipping + $data->admin_fee + $data->fee_random;
            	return number_format($total);
            })
            ->addColumn('action', function($data){
            	$temp = "";
            	if($data->status == 1){
            		$temp .="<a type='button' data-id='".$data->id."' data-change='2' class='btn btn-primary change'>Pembayaran Sukses</a>";
            		$temp .="<a style='margin-left : 10px' type='button' data-id='".$data->id."' data-change='4' class='btn btn-danger change'>Gagal</a>";
            	}

            	return $temp;
            		
            })            
            ->rawColumns(['action'])
            ->make();
    }

    public function change($id, $type)
    {
    	$data = Transaction::find($id);
    	if(! $data)
    		return redirect('transaction');

		$data->status = (int) $type;
		$data->save();
		return redirect('transaction');		    	
    }
}