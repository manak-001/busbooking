<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    use HasFactory;
    protected $table = 'booking_history';
    protected $guarded = ['id'];
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
        $url = 0;
        if ($request->get('url') == 'pending') {
            $url = 1;
        } elseif ($request->get('url') == 'bookedTicket') {
            $url = 2;
        } elseif ($request->get('url') == 'rejectTicket') {
            $url = 3;
        }
        if ($url) {

            $result = BookingHistory::where('status', $url);
        } else {
            $result = BookingHistory::select('*');
        }
        if ($search != null) {
            $result->where(function ($query) use ($search) {
                $query->where('user', 'like', '%' . $search['value'] . '%');
            });
        }
        $total = count($result->get());
        $list = $result->orderBy($request->sortBy, $request->sortType)->offset($start)->limit($limit)->get();
        $list->total = $total;
        return $list;
    }
}
