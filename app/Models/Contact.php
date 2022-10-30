<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table ='contact';
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

        $result = Contact::select('*');
        if ($search != null) {
            $result->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search['value'] . '%')
                ->orwhere('email', 'like', '%' . $search['value'] . '%')
                ->orwhere('phone', 'like', '%' . $search['value'] . '%')
                ->orwhere('address', 'like', '%' . $search['value'] . '%');
            });
        }
        $total = count($result->get());
        $list = $result->orderBy($request->sortBy, $request->sortType)->offset($start)->limit($limit)->get();
        $list->total = $total;
        return $list;
    }
}

