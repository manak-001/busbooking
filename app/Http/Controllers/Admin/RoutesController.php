<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoutesController extends Controller
{
    public function  create()
    {
        return view('admin.Route.add');
    }

    public function  routeSave(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'starting_point' => 'required',
            'ending_pooint' => 'required',
            'distance' => 'required',
            'time' => 'required',
        ]);
        $status = 0;
        if ($request->has('status')) {
            $status = 1;
        }
        $route = new  Route();
        $route->name = $request->get('name');
        $route->starting_point    = $request->get('starting_point');
        $route->ending_point = $request->get('ending_pooint');
        $route->distance = $request->get('distance');
        $route->time = $request->get('time');
        $route->status = $status;
        $route->save();
        return Redirect::to('/admin/manageTrip/route')->with('message', 'Routes Create Successfully');
    }
    public function index()
    {
        return view('admin.Route.index');
    }

    public  function routesList(Request $request)
    {
        $columns = array(
            1 => 'name',
            7 => 'created_at',
        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = Route::getList($request);
        $totalRecords = $result->total;
        $data = array();
        $i = 1;


        if (!empty($result)) {
            foreach ($result as $key => $post) {

                $checked = "";
                if ($post->status == 1) {
                    $checked = "checked";
                }
                $statusUrl = route('admin.route-status');
                $status = "<input type='checkbox' name='sliderstatus' class='form-check-input statusSwitcher' data-value='$post->id' data-url='$statusUrl' $checked  data-bootstrap-switch=''>";
                $editUrl = route('admin.route-edit', $post->id);

                $editBtn = "<a href='$editUrl' class='btn btn-outline-dark btn-sm action_button  edit_country' data-id='$post->id'' >
                                    <i class='fa fa-pencil-alt'></i> Edit                                 
                                </a>";

                "<span> </span>";


                $deleteBtn = "<a href='javascript:void(0)' class =' btn btn-outline-danger btn-sm deleteEntry' data-id='$post->id' >
                                    <i class='fa fa-trash-alt'></i>  
                                    Delete                                    
                                </a>";

                $datas['id'] = $i;
                $datas['name'] = $post->name;
                $datas['starting_point'] = $post->starting_point;
                $datas['ending_point'] = $post->ending_point;
                $datas['distance'] = $post->distance;
                $datas['time'] =date('H:i:s',strTotime($post->time));
                $datas['status'] = $status;
                $datas['created_at'] = date('Y-m-d', strTotime($post->created_at));
                $datas['action'] = $editBtn . $deleteBtn;
                $data[] = $datas;
                $i++;
            }
        }
        $json_data = array(
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalRecords),
            'recordsFiltered' => intval($totalRecords),
            'data' => $data
        );
        echo json_encode($json_data);
    }

    public function status(Request $request)
    {
        $route = Route::find($request->get('id'));
        $status = 0;
        if ($route->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $route->status = $status;
        $route->save();
        return  response(['status' => 1, 'msg' => 'Status Update Successfully']);
    }

    public function edit($id)
    {
        $route = Route::find($id);

        return view('admin.Route.edit')->with(['data' => $route]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'starting_point' => 'required',
            'ending_pooint' => 'required',
            'distance' => 'required',
            'time' => 'required',
        ]);
        $status = 0;
        if ($request->has('status')) {
            $status = 1;
        }
        $route = Route::find($request->get('id'));
        $route->name = $request->get('name');
        $route->starting_point    = $request->get('starting_point');
        $route->ending_point = $request->get('ending_pooint');
        $route->distance = $request->get('distance');
        $route->time = $request->get('time');
        $route->status = $status;
        $route->save();
        return Redirect::to('/admin/manageTrip/route')->with('message', 'Routes Update Successfully');        
    }

    public function delete(Request $request)
    {
        Route::where('id',$request->get('id'))->delete();
        return  response(['status' => 1, 'msg' => 'Routes Delete Successfully']);        
    }
}
