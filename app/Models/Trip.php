<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table ='trip';
    protected $guarded =['id'];
    public static function  getList($request)
    {
        $start = 0;
        $limit = 10;
        $search = null;
        if ($request->has('start')) {
            $start = $request->get('start');
        }
        if ($request->has('length')) {
            $length = $request->get('length');
        }
        if ($request->has('search')) {
            $search = $request->get('search');
        }

        $result = Trip::select('*');
       
        if ($search != null) {
            $result->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search['value'] . '%')
                ->orwhere('type', 'like', '%' . $search['value'] . '%')
                    ->orwhere('day', 'like', '%' . $search['value'] . '%');
            });
        }
        $total = count($result->get());
        $list = $result->orderBy($request->sortBy, $request->sortType)->offset($start)->limit($limit)->get();
        $list->total = $total;
        return $list;
    }
}
