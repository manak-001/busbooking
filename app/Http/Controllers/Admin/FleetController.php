<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FleetType;
use App\Models\SeatLayout;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FleetController extends Controller
{
    public function index()
    {
        return view('admin.SeatLout.index');
    }

    public function layoutlist(Request $request)
    {
        $columns = array(
            1 => 'title',
            2 => 'created_at',

        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = SeatLayout::getList($request);
        $totalRecords = $result->total;
        $data = array();
        $i = 1;


        if (!empty($result)) {
            foreach ($result as $key => $post) {

                $checked = "";
                if ($post->status == 1) {
                    $checked = "checked";
                }
                // $statusUrl = route('categories@status');
                $status = "<input type='checkbox' name='sliderstatus' class='statusSwitcher' data-value='$post->id' data-url='' $checked  data-bootstrap-switch=''>";
                $editUrl = route('admin.bookinghistory-edit', $post->id);
                $editBtn = "";
                $deleteBtn = "";
                $editBtn = "<a href='#' class='btn btn-success btn-sm  edit_layout ' data-id='$post->id' data-title='$post->title' >
                <i class='fa fa-pencil-alt'></i> Edit                                 
            </a>";
                "<span></span>";
                $deleteBtn = "<a href='javascript:void(0)' class =' btn btn-danger btn-sm deleteEntry' data-id='$post->id' >
                                    <i class='fa fa-trash-alt'></i>  
                                    Delete                                    
                                </a>";

                $datas['id'] = $i;
                $datas['layout'] = $post->title;
                $datas['created_at'] = date('d F, Y', strtotime($post->created_at));
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

    public function  create(Request $request)
    {
        try {
            $request->validate([
                'layout' => 'required',
            ]);
            $layout = new SeatLayout();
            $layout->title = $request->get('layout');
            $layout->save();
            if ($layout) {
                return Redirect::back()->with('message', 'Seat Layout Create Successfully');
            }
        } catch (Exception $ex) {
            return  response(['status' => 1, 'msg' => $ex->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'layout' => 'required',
            ]);
            $layout = SeatLayout::find($request->get('id'));
            $layout->title = $request->get('layout');
            $layout->save();
            if ($layout) {
                return Redirect::back()->with('message', 'Seat Layout Update Successfully');
            }
        } catch (Exception $ex) {
            return  response(['status' => 1, 'msg' => $ex->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        $layout = SeatLayout::where('id', $request->get('id'))->delete();
        return  response(['status' => 1, 'msg' => 'Seat Layout Delete Successfully']);
    }

    public function  fleetType()
    {
        $seat_layout = SeatLayout::all();
        return  view('admin.FleetType.index')->with(['seat_layout' => $seat_layout]);
    }
    public function  fleetTypelist(Request $request)
    {
        $columns = array(
            1 => 'title',
            2 => 'created_at',

        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = FleetType::getList($request);
        $totalRecords = $result->total;
        $data = array();
        $i = 1;


        if (!empty($result)) {
            foreach ($result as $key => $post) {

                $checked = "";
                if ($post->status == 1) {
                    $checked = "checked";
                }
                // $statusUrl = route('categories@status');
                $status = "<input type='checkbox' name='sliderstatus' class='statusSwitcher' data-value='$post->id' data-url='' $checked  data-bootstrap-switch=''>";
                $editUrl = route('admin.fleetType-edit', $post->id);
                $editBtn = "";
                $deleteBtn = "";
                $editBtn = "<a href='#' class='btn btn-success btn-sm  edit_layout ' data-id='$post->id' data-name='$post->name' >
                <i class='fa fa-pencil-alt'></i> Edit                                 
            </a>";
                "<span></span>";
                $deleteBtn = "<a href='javascript:void(0)' class =' btn btn-danger btn-sm deleteEntry' data-id='$post->id' >
                                    <i class='fa fa-trash-alt'></i>  
                                    Delete                                    
                                </a>";

                $datas['id'] = $i;
                $datas['name'] = $post->name;
                $datas['layout'] = $post->seat_layout;
                $datas['total_set'] = count($result);
                $datas['facilities'] = $post->facilities;
                $datas['created_at'] = date('d F, Y', strtotime($post->created_at));
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

    public  function fleetTypeSave(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'layout' => 'required',
                'no_of_desk' => 'required',
                'facility' => 'required',
            ]);
            $fleet = new fleetType();
            $fleet->name = $request->get('name');
            $fleet->seat_layout = $request->get('layout');
            $fleet->no_of_desk = $request->get('no_of_desk');
            $fleet->facilities = implode(',', $request->get('facility'));
            $fleet->status = $request->get('status');
            $fleet->save();
            if ($fleet) {
                return Redirect::back()->with('message', 'Fleet Type Save Successfully');
            }
        } catch (Exception $ex) {
            return Redirect::back()->with('message', $ex->getMessage());
        }
    }

    public  function  editfleetType(Request $request)
    {
        $id=$request->get('id');
        $seat_layout = SeatLayout::all();
        $fllet_type = fleetType::find($id);
        // $facility=fleetType::select('facilities')->where('id',$id)->get()->toArray();
        $facility=explode(',',$fllet_type->facilities);
       $view = view('admin.FleetType.edit')->with(['data' => $fllet_type, 'seat_layout' => $seat_layout,'facilities'=>$facility])->render();
        return response(['status'=>1,'view' => $view]);
    }

    public  function deletefleetType(Request $request)
    {
        $fllet_type= fleetType::where('id',$request->get('id'))->delete();
        return Response(['status'=>1,'msg'=>'Fleet Type Delete Successfully']);
    }
}
