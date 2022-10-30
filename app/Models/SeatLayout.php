<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatLayout extends Model
{
    use HasFactory;
    protected $table ='seatlayout';
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

        $result = SeatLayout::select('*');
        if ($search != null) {
            $result->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search['value'] . '%');
                  
            });
        }
        $total = count($result->get());
        $list = $result->orderBy($request->sortBy, $request->sortType)->offset($start)->limit($limit)->get();
        $list->total = $total;
        return $list;
    }
}
