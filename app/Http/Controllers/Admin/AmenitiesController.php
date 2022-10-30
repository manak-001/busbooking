<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class AmenitiesController extends Controller
{
  public function index()
  {
    return view('admin.Amenities.index');
  }
  public function add()
  {
    return  view('admin.Amenities.add');
  }


  public function create(Request $request)
  {
    $request->validate([
        'title' => 'required',
        'icon' => 'required',
    ]);

    $amenities=new Amenities();
    $amenities->title=$request->get('title');
    $amenities->icon=$request->get('icon');
    $amenities->save();
    return redirect::back()->with(['message'=>'Amenities Save Successfully']);
  }
}
