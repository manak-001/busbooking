<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Language as ModelsLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    public function index()
    {

        return view('admin.language.index');
    }
    public function language_list(Request $request)
    {
        $columns = array(
            1 => 'name',
            3 => 'created_at',
        );

        $column = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $sort = $columns[$column];
        $request->sortBy = $sort;
        $request->sortType = $dir;
        $result = ModelsLanguage::getList($request);
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
                $translateUrl = route('admin.language-translate',$post->code);
                $editBtn = "";
                $deleteBtn = "";
                $editBtn = "<a href='javascript:void(0)' class='btn btn-outline-dark btn-sm action_button  edit_language' data-id='$post->id' data-name='$post->name' data-code='$post->code'>
                                <i class='fa fa-pencil-alt'></i> Edit                                 
                            </a>";

                "<span> </span>";


                $deleteBtn = "<a href='javascript:void(0)' class ='approve_button btn btn-outline-danger btn-sm deleteEntry' data-id='$post->id'>
                                <i class='fa fa-trash-alt'></i>  
                                Delete                                    
                            </a>";
                $translate = "<a href='$translateUrl' class ='approve_button btn btn-primary btn-sm' data-id='$post->id'>
                            <i class='fa fa-trash-alt'></i>  
                            Translate                                    
                        </a>";

                $datas['id'] = $i;
                $datas['name'] = $post->name;
                $datas['code'] = $post->code;
                $datas['created_at'] = date('Y-m-d', strtotime($post->created_at));
                $datas['action'] = $editBtn . " " . $deleteBtn . " " . $translate;
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
        $request->validate([
            'language' => 'required',
            'code' => 'required',
            'direction' => 'required',
        ]);

        $user = new ModelsLanguage();
        $user->name = $request->get('language');
        $user->code = $request->get('code');
        $user->direction = $request->get('direction');
        $user->save();
        $this->saveJSONFile($request->get('code'), null);
        return redirect::back()->with(['message' => 'Language Create Successfully']);
    }

    public  function edit(Request $request)
    {
        $language = ModelsLanguage::find($request->get('id'));
        return response(['status' => 1, 'data' => $language]);
    }
    public function  update(Request $request)
    {
         $request->validate([
            'language_name' => 'required',
            'code' => 'required',
            'direction'=>'required',
        ]);

        $user = ModelsLanguage::find($request->get('id'));
        $user->name = $request->get('language_name');
        $user->code = $request->get('code');
        $user->direction = $request->get('direction');
        $user->save();
        return redirect::back()->with(['message' => 'Language Update Successfully']);
    }

    public function delete(Request $request)
    {
        ModelsLanguage::where('id', $request->get('id'))->delete();
        return response(['status' => 1, 'msg' => 'Language Deleet Successfully']);
    }
    public function translate($locale)
    {
        
        // $locale = \App::currentLocale();
        
        $language=$this->openJSONFile($locale);
        return view('admin.language.translate')->with(['data' => $language]);
    }

    private function saveJSONFile($code, $user)
    {
        $config = \Config::get('languages_key');
        $user = array();
        foreach ($config as $key => $value) {
            $user[$value] = $value;
        }
        $jsonData = "";
        if (isset($user)) {
            ksort($user);
            $jsonData = json_encode($user, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        //        if (!File::exists('resources/lang/' . $code)) {
        //            // dir doesn't exist, make it
        //            File::makeDirectory(base_path() . "/resources/lang/$code", 0777, true);
        //        }

        file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
    }
    private function openJSONFile($code) {
        $jsonString = [];
        if (File::exists(base_path('/resources/lang/' . $code . '.json'))) {
            $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }

    public function translate_update(Request $request)
    {
dd($request->all());
    }

    public function switch($code)
    {
       \App::setlocale($code);
        return redirect::back();
        
    }
}
