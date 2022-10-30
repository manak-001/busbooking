<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
  public function index()
  {
    return view('admin.users.index');
  }
  public function create()
  {
    $country = Country::all();
    return view('admin.users.add')->with(['country' => $country]);
  }
  public function saveUser(Request $request)
  {

    $request->validate([
      'name' => 'required',
      'phone' => 'required',
      'country' => 'required',
      'Join_at' => 'required',
      'email' => 'required',
      'password' => 'required',
    ]);

    $user = new User();
    $user->name = $request->get('name');
    $user->phone = $request->get('phone');
    $user->country_id = $request->get('country');
    $user->join_at = $request->get('Join_at');
    $user->email = $request->get('email');
    $user->password = bcrypt($request->get('password'));
    if ($user->save()) {
      return Redirect::to('/admin/users')->with('message', 'Users Addedd Successfully');
    }
  }

  public function userList(Request $request)
  {
    $columns = array(
      1 => 'name',
      2 => 'currency',
      3 => 'created_at',
    );

    $column = $request->input('order.0.column');
    $dir = $request->input('order.0.dir');
    $sort = $columns[$column];
    $request->sortBy = $sort;
    $request->sortType = $dir;
    $result = User::getList($request);
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
        $editUrl = route('admin.users.edit', $post->id);
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
        $datas['phone'] = $post->phone;
        $datas['email'] = $post->email;
        $datas['country'] = $post->country_name;
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

  public function edit($id)
  {
    $users = User::find($id);
    $country = Country::all();
    return view('admin.users.edit')->with(['data' => $users, 'country' => $country]);
  }

  public function update(Request $request)
  {
    try {
      $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'country' => 'required',
        'Join_at' => 'required',
        'email' => 'required',

      ]);

      $user = User::find($request->get('id'));
      $user->name = $request->get('name');
      $user->phone = $request->get('phone');
      $user->country_id = $request->get('country');
      $user->join_at = $request->get('Join_at');
      $user->email = $request->get('email');
      $user->password = bcrypt($request->get('password'));
      if ($user->save()) {
        return Redirect::to('/admin/users')->with('message', 'Users Update Successfully');
      }
    } catch (Exception $ex) {
      return redirect::back()->with('message', $ex->getMessage());
    }
  }

  public function delete(Request $request)
  {
    $users = User::where('id', $request)->delete();
    if ($users) {
      return response(['status' => 1, 'msg' => 'Users Update Successfully']);
    }
  }

  public  function logout()
  {
    Auth::logout();
    return redirect::to('login');
    
  }
}
