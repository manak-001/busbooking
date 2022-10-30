<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;
    protected $table='vehicles';
    protected $guarded=['id'];

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

        $result = Vehicles::select('*');
        if ($search != null) {
            $result->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search['value'] . '%')
                    ->orwhere('reg_no', 'like', '%' . $search['value'] . '%')
                    ->orwhere('engine_no', 'like', '%' . $search['value'] . '%')
                    ->orwhere('chasis_no', 'like', '%' . $search['value'] . '%')
                    ->orwhere('fleet_type', 'like', '%' . $search['value'] . '%');
            });
        }
        $total = count($result->get());
        $list = $result->orderBy($request->sortBy, $request->sortType)->offset($start)->limit($limit)->get();
        $list->total = $total;
        return $list;
    }
}
