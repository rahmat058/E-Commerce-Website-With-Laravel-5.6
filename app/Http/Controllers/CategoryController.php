<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Session;
use DB;

Session_start();

class CategoryController extends Controller
{
    public function index()
    {
      return view('admin.add_category');
    }

    public function all_category()
    {
      $all_category_info = DB::table('tbl_category')
                           -> get();
      $manage_category =  view('admin.all_category')
                           -> with('all_category_info', $all_category_info);

      return view('admin_layout')
              -> with('admin.all_category', $manage_category);
    }

    public function save_category(Request $request)
    {
      $data = array();
      $data['category_id']          = $request->category_id;
      $data['category_name']        = $request->category_name;
      $data['category_description'] = $request->category_description;
      $data['publication_status']   = $request->publication_status;

      DB::table('tbl_category')->insert($data);
      Session::put('message', 'Category Added Successfully !!');
      return Redirect::to('/add-category');
    }

    public function unactive_category($category_id)
    {
      DB::table('tbl_category')
             -> where('category_id', $category_id)
             -> update(['publication_status' => 0]);

      Session::put('message', 'Category Unactive Successfully !!');
      return Redirect::to('/all-category');
    }

    public function active_category($category_id)
    {
      DB::table('tbl_category')
             -> where('category_id', $category_id)
             -> update(['publication_status' => 1]);

      Session::put('message', 'Category Active Successfully !!');
      return Redirect::to('/all-category');
    }
}
