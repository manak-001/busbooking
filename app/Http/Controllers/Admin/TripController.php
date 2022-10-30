<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Redirect;

class TripController extends Controller
{

    public function index()
    {
        return view('admin.Trip.index');
    }

    public function TripList(Request $request)
    {
        $columns = array(
            1 => 'title',
            2 => 'type',
            3  => 'created_at',
        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = Trip::getList($request);
        $totalRecords = $result->total;
        $data = array();
        $i = 1;


        if (!empty($result)) {
            foreach ($result as $key => $post) {

                $checked = "";
                if ($post->status == 1) {
                    $checked = "checked";
                }
                // $statusUrl = route('admin.Trip-status');
                $status = "<input type='checkbox' name='sliderstatus' class='form-check-input statusSwitcher' data-value='$post->id' data-url='' $checked  data-bootstrap-switch=''>";
                $editUrl = route('admin.trip-edit', $post->id);

                $editBtn = "<a href='$editUrl' class='btn btn-outline-dark btn-sm action_button  edit_Trip' data-id='$post->id' data-name='$post->name' data-currency='$post->currency' >
                                    <i class='fa fa-pencil-alt'></i> Edit                                 
                                </a>";

                "<span> </span>";


                $deleteBtn = "<a href='javascript:void(0)' class =' btn btn-outline-danger btn-sm deleteEntry' data-id='$post->id'>
                                    <i class='fa fa-trash-alt'></i>  
                                    Delete                                    
                                </a>";

                $datas['id'] = $i;
                $datas['title'] = $post->title;
                $datas['type'] = $post->type;
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
    public function create()
    {

        return view('admin.Trip.add');
    }
    public function TripSave(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'day' => 'required',

        ]);
        $status = 0;
        if ($request->get('status') == 'on') {
            $status = 1;
        }
        $trip = new Trip();
        $trip->title = $request->get('title');
        $trip->type = $request->get('type');
        $trip->day = $request->get('day');
        $trip->status = $status;
        $trip->save();
        if ($trip) {
            return Redirect::to('/admin/manageTrip/trip')->with('message', 'Trip Addedd Successfully');
        }
    }

    public function edit($id)
    {
        $trip = Trip::find($id);
       
        return view('admin.Trip.edit')->with(['data' => $trip]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'day' => 'required',

        ]);
        $status = 0;
        if ($request->get('status') == 'on') {
            $status = 1;
        }
        $trip = Trip::find($request->get('id'));
        $trip->title = $request->get('title');
        $trip->type = $request->get('type');
        $trip->day = $request->get('day');
        $trip->status = $status;
        $trip->save();
        if ($trip) {
            return Redirect::to('/admin/manageTrip/trip')->with('message', 'Trip Update Successfully');
        }
    }

    public function delete(Request $request)
    {
        $trip = Trip::where('id', $request->get('id'))->delete();
        if ($trip) {
            return response(['status' => 1, 'msg' => 'Trip Delete Successfully']);
        }
    }
}
