<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kodami\Models\Mysql\Category;
use Kodami\Models\Mysql\Koprasi;
use Kodami\Models\Mysql\KodamiProduct;
use Kodami\Models\Mysql\Product;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ProductController extends Controller
{

    public function index($id)
    {
    	$koprasi = Koprasi::find($id);
    	if(! $koprasi)
    		return redirect('vendor');

		return view('vendor.product.index', ['vendor' => $koprasi]);
    }

    public function show($id)
    {
		$koprasi = Koprasi::find($id);
    	if(! $koprasi)
    		return redirect('vendor');

    	 DB::statement(DB::raw('set @rownum=0'));        
        $model = Product::select('products.*', DB::raw('@rownum  := @rownum  + 1 AS row'))->where('koprasi_id', $id);

        return DataTables::eloquent($model)            
            ->addColumn('image', function($data){               
                return "<img src='".$data->primary_image."' width='100px'>";
            })
            ->addColumn('is_validated', function($data){               
                if($data->is_validate == 0)
                    $temp = "<button type='button' class='btn' style='background:red; color: white' ><b>Not Validated</b></button>";
                else
                    $temp = "<button type='button' class='btn btn-primary'>Validated</button>";

                return $temp;
            })
            ->addColumn('action', function($data) use($id){              
                return "<a class='btn btn-primary' href='".url('vendor/'.$id.'/product/'.$data->id.'/detail')."'>  Lihat Detail </a>";
            })
            ->addColumn('category_name', function($data){              
                return $data->category->name ? $data->category->name : "";
            })
            ->addColumn('price', function($data){              
                return number_format($data->price);
            })
            ->rawColumns(['action', 'image', 'is_validated', 'category_name'])
            ->make();
    }

    public function detail($id_koprasi, $id)
    {
    	$koprasi = Koprasi::find($id_koprasi);
    	if(! $koprasi)
    		return redirect('vendor');

    	$product = Product::find($id);
    	if(! $product)
    		return redirect('vendor/'.$id_koprasi.'/product');

    	$category = Category::where('active', 1)->where('parent_id', 0)->get();
    	$kodamiProduct = KodamiProduct::where('status', 1)->get();

    	return view('vendor.product.detail', ['vendor' => $koprasi, 'product' => $product, 'category' => $category, 'kodami_product' => $kodamiProduct]);
    }

    public function change_status($id_koprasi, $id, Request $request)
    {
    	$kodami_product_id = $request->Kodami_product_id ? $request->Kodami_product_id : null;

    	$koprasi = Koprasi::find($id_koprasi);
    	if(! $koprasi)
    		return redirect('vendor');

    	$product = Product::find($id);
    	if(! $product)
    		return redirect('vendor/'.$id_koprasi.'/product');

    	if($product->is_validate == 1)
    		$is_validate = 0;
    	else
    		$is_validate = 1;

    	$product->is_validate = $is_validate;
    	$product->kodami_product_id = $kodami_product_id;

    	$product->save();

    	return redirect('vendor/'.$id_koprasi.'/product');
    }
}
