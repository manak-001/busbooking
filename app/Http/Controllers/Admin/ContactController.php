<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contact.index');
    }
    public function contact_list(Request $request)
    {
        $columns = array(
            1 => 'title',
            3 => 'address',
            4 => 'email',
            5 => 'phone',
            6 => 'created_at',
        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = Contact::getList($request);
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
                $editUrl = route('admin.contact.edit', $post->id);
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
                $datas['title'] = $post->title;
                $datas['address'] = $post->address;
                $datas['email'] = $post->email;
                $datas['phone'] = $post->phone;
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

    public function add()
    {
        return view('admin.contact.add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'details' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $user = new Contact();
        $user->title = $request->get('title');
        $user->phone = $request->get('phone');
        $user->details = $request->get('details');
        $user->address = $request->get('address');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->save();

        return redirect::to('admin/section/contact/')->with(['massage' => 'Contact Details Create Successfully']);
    }

    public  function edit($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit ')->with(['data' => $contact]);
    }
    public function update(Request $request)
    {
       $request->validate([
            'title' => 'required',
            'details' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $user = Contact::find($request->get('id'));
        $user->title = $request->get('title');
        $user->phone = $request->get('phone');
        $user->details = $request->get('details');
        $user->address = $request->get('address');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        if ($user->save()) {
             return redirect::to('admin/section/contact/')->with(['message' => 'Contact Update  Successfully']);
        }
    }

    public  function delete(Request $request)
    {
        Contact::where('id',$request->get('id'))->delete();
        return response(['status'=>1,'msg'=>'Contact Details  Delete Successfully']);
    }
}
