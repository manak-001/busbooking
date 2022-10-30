<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CounterController extends Controller
{
    public function index()
    {
        return view('admin.counter.index');
    }

    public function user_list(Request $request)
    {
        $columns = array(
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4=>'created_at',
        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = Counter::getList($request);
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
                $editUrl = route('admin.counter.edit', $post->id);
                $editBtn = "";
                $deleteBtn = "";
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
                $datas['email'] = $post->email;
                $datas['phone'] = $post->phone;
                $datas['created_at'] = date('Y-m-d',strtotime($post->created_at));
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
    public function  add()
    {
        return view('admin.counter.add');        
    }

    public function  create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'location' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user=new Counter();
        $user->name=$request->get('name');
        $user->phone=$request->get('mobile');
        $user->city=$request->get('city');
        $user->location=$request->get('location');
        $user->email =$request->get('email');
        $user->password=bcrypt($request->get('password'));
        $user->save();

        return redirect::to('admin/counter/')->with(['message'=>'Couter create Successfully']);

    }

    public function edit($id)
    {
        $user=Counter::find($id);
        return view('admin.counter.edit')->with(['data'=> $user]);       
    }

    public function update(Request $request){
         $request->validate([
            'name' => 'required',
            'city' => 'required',
            'location' => 'required',
        
        ]);

        $user=Counter::find($request->get('id'));
        $user->name=$request->get('name');
        $user->phone=$request->get('mobile');
        $user->city=$request->get('city');
        $user->location=$request->get('location');
        $user->save();
        return redirect::to('admin/counter/')->with(['message'=>'Couter update Successfully']);
    }

    public function delete(Request $request)
    {
        Counter::where('id',$request->get('id'))->delete();
        return response(['status'=>1,'msg'=>'Couter Deleet Successfully']);
    }
}
