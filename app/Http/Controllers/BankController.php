<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\Bank;
use Yajra\DataTables\Facades\DataTables;
use DB;

class BankController  extends Controller
{
	public function index(Request $request)
    {    	
		return view('bank.index');
    }

    public function show()
    {
        DB::statement(DB::raw('set @rownum=0'));        
        $model = Bank::select('bank.*', DB::raw('@rownum  := @rownum  + 1 AS row'));

        return DataTables::eloquent($model)            
            ->addColumn('image', function($data){               
                return "<img src='".$data->image."' width='100px'>";
            })
            ->addColumn('action', function($data){              
                $temp="<a type='button' href='".URL('bank/'.$data->id."/edit")."' data-id='".$data->id."' class='btn btn-primary change'>Edit</a>";
                $temp .="<a style='margin-left : 10px' type='button' data-id='".$data->id."'class='btn btn-warning delete'>Delete</a>";
                return $temp;
            })
            ->rawColumns(['action', 'image', 'status', 'long_description'])
            ->make();
    }

    public function create()
    {
        return view('bank.create');
    }

    public function store(Request $request)
    {
        $data = new Bank;
        $data->nama = $request->name;
        $data->no_rekening = $request->no_rekening;
        $data->owner = $request->owner;
        $data->image = $request->image;
        $data->save();
        return redirect('bank');
    }

    public function edit($id)
    {
        $bank = Bank::find($id);
        if(! $bank)
            return redirect('bank');

        return view('bank.edit', ['bank' => $bank]);   
    }

    public function put($id, Request $request)
    {
        $data = Bank::find($id);
        if(! $data)
            return redirect('bank');

        $data->nama = $request->name;
        $data->no_rekening = $request->no_rekening;
        $data->owner = $request->owner;
        $data->image = $request->image ? $request->image : $request->old_image;
        $data->save();
        return redirect('bank');
    }

    public function destroy($id)
    {
        $data = Bank::find($id);
        if(! $data)
            return redirect('bank');

        $data->delete();
        return redirect('bank');
    }
}