<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Kodami\Models\Mysql\BannerSlideshow;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    public function index()
    {    	
    	return view('banner.index');
    }

    public function show()
    {
        DB::statement(DB::raw('set @rownum=0'));        
    	$model = BannerSlideshow::select('banner_slideshow.*', DB::raw('@rownum  := @rownum  + 1 AS row'));

		return DataTables::eloquent($model)
            ->addColumn('image_base', function($data){
            	if(isset($data->image)) {
                    return '<img src="'. $data->image . '" class="img-responsive" style="width:600px"/>';
                } else
                    return '-';
            })
            ->addColumn('action', function($data){
            	return "<a type='button' href='banners/".$data->id."/edit' class='btn btn-primary'>Edit</a> <a type='button' data-id='".$data->id."' class='btn btn-danger delete'>Delete</a>";
            })
            ->addColumn('status', function($data){
            	return "";
            })
            ->rawColumns(['image_base', 'action'])
            ->make();
    }

    public function create()
    {
        return view('banner.create');
    }

    public function store(Request $request)
    {
        $status = $request->active ? (int) $request->active : 0;
        $order = $request->order ? (int) $request->order : 0;
        $deskripsi = $request->deskripsi ? $request->deskripsi : "";
        $banner_image = $request->banner_image ? $request->banner_image : "";

        $data = new BannerSlideshow;
        $data->descripsi = $deskripsi;
        $data->image = $banner_image;
        $data->urut = $order;
        $data->status = $status;
        $data->type = 1;
        $data->save();

        return redirect('banners');
    }

    public function edit($id)
    {
        $data = BannerSlideshow::find($id);
        if(! $data)
            return redirect('banners');
        
        return view('banner.edit', ['banner' => $data]);
    }

    public function put($id, Request $request)
    {
        $data = BannerSlideshow::find($id);

        if(! $data)
            return redirect('banners');

        $status = $request->active ? (int) $request->active : 0;
        $order = $request->order ? (int) $request->order : 0;
        $deskripsi = $request->deskripsi ? $request->deskripsi : "";
        $banner_image = $request->banner_image ? $request->banner_image : $request->image_before;


        $data->descripsi = $deskripsi;
        $data->image = $banner_image;
        $data->urut = $order;
        $data->status = $status;
        $data->type = 1;
        $data->save();

        return redirect('banners');
    }

    public function destroy($id)
    {
        $data = BannerSlideshow::find($id);
        if($data)
            $data->delete();
        
        return redirect('banners');
    }
}
