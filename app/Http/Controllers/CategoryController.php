<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodami\Models\Mysql\Category;
use Kodami\Models\Mysql\CategoryCriteria;
use Kodami\Models\Mysql\CategorySpesification;
use Kodami\Models\Mysql\JunkCategoryCriteria;
use Kodami\Models\Mysql\JunkCategorySpesification;
use Yajra\DataTables\Facades\DataTables;
use DB;

class CategoryController extends Controller
{
    public function ajaxGetChild(Request $request)
    {
        $parent_id = ($request->parent_id  ? $request->parent_id : 0);
        $data = Category::select('id', 'name', 'full_name')->where('parent_id', $parent_id)->get();

        return $data;
    }

    public function criteria(Request $request)
    {
    	$data = JunkCategoryCriteria::select('*')    			
    			->leftJoin('category_criteria', 'category_criteria.id', '=', 'category_criteria_id')
    			->with('selection')
    			->where('category_id', $request->category_id)
    			->get();

    	return $data;
    }

    public function spesification(Request $request)
    {
    	$data = JunkCategorySpesification::select("*")
    			->leftJoin('category_spesifications', 'category_spesifications.id', '=', 'category_spesification_id')
    			->where('category_id', $request->category_id)
    			->get();
    	return $data;
    }
}
