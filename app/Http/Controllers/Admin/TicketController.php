<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FleetType;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Redirect;
class TicketController extends Controller
{
    
    public function index()
    {
        return view('admin.Ticket.index');
    }

    public function TicketList(Request $request)
    {
        $columns = array(
            1 => 'fleet_type.name',
            2 => 'route.name',
            3 => 'price',
            4=>'created_at',
        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = Ticket::getList($request);
        $totalRecords = $result->total;
        $data = array();
        $i = 1;


        if (!empty($result)) {
            foreach ($result as $key => $post) {

                $checked = "";
                if ($post->status == 1) {
                    $checked = "checked";
                }
                // $statusUrl = route('admin.Ticket-status');
                $status = "<input type='checkbox' name='sliderstatus' class='form-check-input statusSwitcher' data-value='$post->id' data-url='' $checked  data-bootstrap-switch=''>";
                $editUrl = route('admin.ticket-edit', $post->id);
                
                    $editBtn = "<a href='$editUrl' class='btn btn-outline-dark btn-sm action_button  edit_Ticket' data-id='$post->id' data-name='$post->name' data-currency='$post->currency' >
                                    <i class='fa fa-pencil-alt'></i> Edit                                 
                                </a>";

                "<span> </span>";
               

                $deleteBtn = "<a href='javascript:void(0)' class =' btn btn-outline-danger btn-sm deleteEntry' data-id='$post->id'>
                                    <i class='fa fa-trash-alt'></i>  
                                    Delete                                    
                                </a>";

                $datas['id'] = $i;
                $datas['type'] = $post->type_name;
                $datas['route'] = $post->route_name;
                $datas['price'] = $post->price;
                $datas['created_at'] = date('Y-m-d',strTotime($post->created_at));
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
        $fleet_type=FleetType::all();
        $route=Route::all();
        return view('admin.Ticket.add')->with(['fleet_type'=>$fleet_type,'route'=>$route]);
    }
    public function TicketSave(Request $request)
    {
        $request->validate([
            'fleet_type' => 'required',
            'route' => 'required',
            'price' => 'required',
           
        ]);
        
     $ticket = new Ticket();
        $ticket->feet_type = $request->get('fleet_type');
        $ticket->route = $request->get('route');
        $ticket->price = $request->get('price');
        $ticket->save();
        if ($ticket) {
            return Redirect::to('/admin/manageTrip/ticket')->with('message', 'Ticket Addedd Successfully');
        }
    }

    public function edit($id)
    {
       $ticket=Ticket::find($id);
       $fleet_type=FleetType::all();
       $route=Route::all();
       return view('admin.Ticket.edit')->with(['data'=>$ticket,'fleet_type'=>$fleet_type,'route'=>$route]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'fleet_type' => 'required',
            'route' => 'required',
            'price' => 'required',
        ]);
      
        $ticket = Ticket::find($request->get('id'));
        $ticket->feet_type = $request->get('fleet_type');
        $ticket->route = $request->get('route');
        $ticket->price = $request->get('price');
        $ticket->save();
        if ($ticket) {
            return Redirect::to('/admin/manageTrip/ticket')->with('message', 'Ticket Update Successfully');
          
        }
    }

    public function delete(Request $request)
    {
        $ticket=Ticket::where('id',$request->get('id'))->delete();
        if ($ticket) {
            return response(['status'=>1,'msg'=>'Ticket Delete Successfully']);
          
        }
    }
}
