<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class AboutController extends Controller
{
    public function about()
    {
        $contet=About::first();
        return view('admin.section.about')->with(['data'=>$contet]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'heading' => 'required',
            'sort_description' => 'required',
            'title' => 'required',
            'desription' => 'required',
        ]);
        if ($request->has('image')) {
            $image = $request->file('image')->store('about', 'public');
        }
        $contet=About::first();
        if(null==$contet)
        {
         $about = new About();  
            $about->image = $image;
            $about->heading = $request->get('heading');
            $about->short_description = $request->get('sort_description');
            $about->title = $request->get('title');
            $about->description = $request->get('desription');
            $about->image=$image;
            $about->save();
            return redirect::back()->with(['message'=>'Project About Save Successfully']);
        }
        else{
            $about =About::find(1);  
            $about->image = $image;
            $about->heading = $request->get('heading');
            $about->short_description = $request->get('sort_description');
            $about->title = $request->get('title');
            $about->heading = $request->get('desription');
            $about->image=$image;
            $about->save();
            return redirect::back()->with(['message'=>'Project About Update Successfully']);
        }
        
    }
}
