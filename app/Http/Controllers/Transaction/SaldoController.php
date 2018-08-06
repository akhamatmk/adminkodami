<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kodami\Models\Mysql\Transaction;
use Kodami\Models\Mysql\Member_2 as Member;
use Yajra\DataTables\Facades\DataTables;
use DB;

class SaldoController extends Controller
{
    public function index()
    {
        return view('transaction.saldo.index');
    }

    public function show()
    {
    	DB::statement(DB::raw('set @rownum=0'));        
    	$model = Transaction::select('transactions.*', DB::raw('@rownum  := @rownum  + 1 AS row'))->where('type_transaction', 2);

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
            		case 0:
            			return "Menunggu Pembayaran";
            			break;
            		case 1:
            			return "Proses Pengiriman";
            			break;
            		case 2:
            			return "Transaksi Berhasil";
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
            	if($data->status == 0){
            		$temp .="<a type='button' data-id='".$data->id."' data-change='2' class='btn btn-primary change'>Confirm Pembayaran</a>";
            		$temp .="<a style='margin-left : 10px' type='button' data-id='".$data->id."' data-change='4' class='btn btn-danger change'>Gagalkan Transaksi</a>";
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

		if($type == 2)
		{
			$member = Member::find($data->member_id);
			if($member)
			{
				$member->saldo = $member->saldo + $data->price_product;
				$member->save();
			}
		}
		
		return redirect('transaction/saldo');
    }
}
