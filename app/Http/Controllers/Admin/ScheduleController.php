<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Schedule;
class ScheduleController extends Controller
{
    public function index()
    {
        return view('admin.schedule.index');
    }

    public function scheduleList(Request $request)
    {
        $columns = array(
            1 => 'start_from',
            2 => 'end_at',
            3 => 'duration',
            4=>'created_at',
        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = Schedule::getList($request);
        $totalRecords = $result->total;
        $data = array();
        $i = 1;


        if (!empty($result)) {
            foreach ($result as $key => $post) {

                $checked = "";
                if ($post->status == 1) {
                    $checked = "checked";
                }
                $statusUrl = route('admin.schedule-status');
                $status = "<input type='checkbox' name='sliderstatus' class='form-check-input statusSwitcher' data-value='$post->id' data-url='$statusUrl' $checked  data-bootstrap-switch=''>";
                $editUrl = route('admin.schedule-edit', $post->id);
                
                    $editBtn = "<a href='$editUrl' class='btn btn-outline-dark btn-sm action_button  edit_schedule' data-id='$post->id' data-name='$post->name' data-currency='$post->currency' >
                                    <i class='fa fa-pencil-alt'></i> Edit                                 
                                </a>";

                "<span> </span>";
               

                $deleteBtn = "<a href='javascript:void(0)' class =' btn btn-outline-danger btn-sm deleteEntry' data-id='$post->id'>
                                    <i class='fa fa-trash-alt'></i>  
                                    Delete                                    
                                </a>";

                $datas['id'] = $i;
                $datas['start'] = $post->start_from;
                $datas['end'] = $post->end_at;
                $datas['duration'] = $post->duration;
                $datas['status'] = $status;
                $datas['created_at'] = date($post->created_at);
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
        return view('admin.schedule.add');
    }
    public function scheduleSave(Request $request)
    {
        $request->validate([
            'start_from' => 'required',
            'end_at' => 'required',
            'duration' => 'required',
           
        ]);
        $status=0;
        if( $request->get('status'))
        {
            $status=1;
        }

        $schedule = new Schedule();
        $schedule->start_from = $request->get('start_from');
        $schedule->end_at = $request->get('end_at');
        $schedule->duration = $request->get('duration');
        $schedule->status =  $status;
        $schedule->save();
        if ($schedule) {
            return Redirect::to('/admin/manageTrip/schedule')->with('message', 'Schedule Addedd Successfully');
        }
    }

    public function edit($id)
    {
       $schedule=Schedule::find($id);
       return view('admin.schedule.edit')->with(['data'=>$schedule]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'start_from' => 'required',
            'end_at' => 'required',
            'duration' => 'required',
        ]);
        $status=0;
        if( $request->get('status'))
        {
            $status=1;
        }
        $schedule = Schedule::find($request->get('id'));
        $schedule->start_from = $request->get('start_from');
        $schedule->end_at = $request->get('end_at');
        $schedule->duration = $request->get('duration');
       $schedule->save();
        if ($schedule) {
            return Redirect::to('/admin/manageTrip/schedule')->with('message', 'Schedule Update Successfully');
          
        }
    }

    public function delete(Request $request)
    {
        $schedule=Schedule::where('id',$request->get('id'))->delete();
        if ($schedule) {
            return response(['status'=>1,'msg'=>'Schedule Delete Successfully']);
          
        }
    }
}
