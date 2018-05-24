<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kodami\Models\Mysql\Province;

class InternController extends Controller
{
    public function index()
    {
        return view('vendor.intern.index');
    }

    public function create()
    {
    	$data['province'] = province::get();
    	return view('vendor.intern.create', $data);
    }

    public function store(Request $request)
    {
    	print_r($_POST);
    }
}
