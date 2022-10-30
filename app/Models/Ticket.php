<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table ='ticket';
    protected $guarded=['id'];
    public  function type()
    {
        return $this->belongsTo(FleetType::class ,'feet_type');
    }
    public function routes()
    {
        return $this->belongsTo(Route::class,'route');
    }
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

        $result = Ticket::select('ticket.*','route.name as route_name','fleet_type.name as type_name')
        ->join('route','ticket.route','=','route.id')
        ->join('fleet_type','ticket.feet_type','=','fleet_type.id')
        ;
        if ($search != null) {
            $result->where(function ($query) use ($search) {
                $query->where('fleet_type.name', 'like', '%' . $search['value'] . '%')
                ->orwhere('price', 'like', '%' . $search['value'] . '%')
                    ->orwhere('route.name', 'like', '%' . $search['value'] . '%');
            });
        }
        $total = count($result->get());
        $list = $result->orderBy($request->sortBy, $request->sortType)->offset($start)->limit($limit)->get();
        $list->total = $total;
        return $list;
    }
}
