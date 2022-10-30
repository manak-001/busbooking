<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Nette\Utils\Validators;
use Illuminate\Support\Facades\Redirect;
class CountryController extends Controller
{
    public function index()
    {
        return view('admin.country.index');
    }

    public function country_list(Request $request)
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
        $result = Country::getList($request);
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
                $editUrl = route('admin.country-edit', $post->id);
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
                $datas['currency'] = $post->currency;
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
        return view('admin.country.add');
    }
    public function savecountry(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'currency' => 'required',
        ]);

        $country = new Country();
        $country->name = $request->get('country');
        $country->currency = $request->get('currency');
        $country->save();
        if ($country) {
            return Redirect::to('/admin/country')->with('message', 'Country Addedd Successfully');
        }
    }

    public function edit($id)
    {
       $counrty=Country::find($id);
       return view('admin.country.edit')->with(['data'=>$counrty]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'currency' => 'required',
        ]);

        $country = Country::find($request->get('country_id'));
        $country->name = $request->get('country');
        $country->currency = $request->get('currency');
        $country->save();
        if ($country) {
            return Redirect::to('/admin/country')->with('message', 'Country Update Successfully');
          
        }
    }

    public function delete(Request $request)
    {
        $country=Country::where('id',$request->get('id'))->delete();
        if ($country) {
            return Redirect::to('/admin/country')->with('message', 'Country Update Successfully');
          
        }
    }
}
