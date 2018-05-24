<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\KodamiProduct;
use Kodami\Models\Mysql\Category;
use Yajra\DataTables\Facades\DataTables;
use DB;

class UploadController extends Controller
{
	public function imageUpload()
    {
        return 1;
    }
}