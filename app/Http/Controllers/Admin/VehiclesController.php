<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VehiclesController extends Controller
{
    public  function index()
    {
        return view('admin.vehicles.index');
    }

    public function vehicles(Request $request)
    {
        $columns = array(
            1 => 'trip',
            2=>'name',
            3=>'reg_no',
            4 => 'created_at',
        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = Vehicles::getList($request);
        $totalRecords = $result->total;
        $data = array();
        $i = 1;


        if (!empty($result)) {
            foreach ($result as $key => $post) {

                $checked = "";
                if ($post->status == 1) {
                    $checked = "checked";
                }
                $statusUrl = route('admin.vehicles-status');
                $status = "<input type='checkbox' name='sliderstatus' class='statusSwitcher form-check-input' data-value='$post->id' data-url='$statusUrl' $checked  data-bootstrap-switch=''>";
                $editUrl = route('admin.vehicles-edit', $post->id);
                $editBtn = "<a href='$editUrl' class='btn btn-outline-dark btn-sm action_button  edit_country' data-id='$post->id' data-name='$post->name' data-currency='$post->currency' >
                                    <i class='fa fa-pencil-alt'></i> Edit                                 
                                </a>";

                "<span> </span>";


                $deleteBtn = "<a href='javascript:void(0)' class ='approve_button btn btn-outline-danger btn-sm deleteEntry' data-id='$post->id'>
                                    <i class='fa fa-trash-alt'></i>  
                                    Delete                                    
                                </a>";

                $datas['id'] = $i;
                $datas['name'] = $post->name;
                $datas['reg_no'] = $post->reg_no;
                $datas['engine_no'] = $post->engine_no;
                $datas['chasis_no'] = $post->chasis_no;
                $datas['model_no'] = $post->model_no;
                $datas['fllet_type'] = $post->fleet_type;
                $datas['status'] = $status;
                $datas['created_at'] = date('Y-m-d', strtotime($post->created_at));
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
    public function vehiclesCreate()
    {
        return view('admin.vehicles.add');
    }
    public function vehiclesSave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'reg_no' => 'required',
            'engine_no' => 'required',
            'chasis_no' => 'required',
            'model_no' => 'required',
            'type' => 'required',
        ]);
        $status = 0;
        if ($request->get('status') == 'on') {
            $status = 1;
        }
        $vehicles = new Vehicles();
        $vehicles->name = $request->get('name');
        $vehicles->reg_no = $request->get('reg_no');
        $vehicles->engine_no = $request->get('engine_no');
        $vehicles->chasis_no = $request->get('chasis_no');
        $vehicles->model_no = $request->get('model_no');
        $vehicles->fleet_type = $request->get('type');
        $vehicles->status = $status;
        $vehicles->save();
        \Session(['success' => 'Vihcle Deatails saved successfully']);
        return redirect::to('/admin/manage/vehicles')->with(['massage' => 'Vehicles Create Successfully']);
    }
    public function status(Request $request)
    {
        try {
            $vehicles = Vehicles::find($request->get('id'));
            $status = 0;
            if ($vehicles->status == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $vehicles->$status;
            $vehicles->save();
            return response(['status' => 1, 'msg' => 'Status Update Successfully']);
        } catch (Exception $ex) {
            return response(['status' => 0, 'msg' => $ex->getMessage()]);
        }
    }
    public function edit($id)
    {
        $vehicles = Vehicles::find($id);
        return view('admin.vehicles.edit')->with(['vehicles'=>$vehicles]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'reg_no' => 'required',
            'engine_no' => 'required',
            'chasis_no' => 'required',
            'model_no' => 'required',
            'type' => 'required',
        ]);
        $status = 0;
        if ($request->get('status') == 'on') {
            $status = 1;
        }

        $vehicles=Vehicles::find($request->get('id'));
        $vehicles->name = $request->get('name');
        $vehicles->reg_no = $request->get('reg_no');
        $vehicles->engine_no = $request->get('engine_no');
        $vehicles->chasis_no = $request->get('chasis_no');
        $vehicles->model_no = $request->get('model_no');
        $vehicles->fleet_type = $request->get('type');
        $vehicles->status = $status;
        $vehicles->save();
        \Session(['success' => 'Vehicle Deatails Update successfully']);
        return redirect::to('/admin/manage/vehicles');
    }
    public function delete(Request $request)
    {
        try {
            Vehicles::where('id', $request->get('id'))->delete();
        } catch (Exception $ex) {
            return response(['status' => 0, 'msg' => $ex->getMessage()]);
        }
        return response(['status' => 1, 'msg' => 'Vehichle Delete Successfully']);
    }
}
