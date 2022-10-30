<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BookingHistoryController extends Controller
{
   public function index($url=null)
   {
       return view('admin.BookingHistory.index')->with(['url'=>$url]);
   }
   public function create()
   {
      return view('admin.BookingHistory.add');
   }

   public  function saveData(Request $request)
   {
      $request->validate([
         'name' => 'required',
         'Pnrnumber' => 'required',
         'Jourany_date' => 'required',
         'trip' => 'required',
         'pickuppoint' => 'required',
         'dropping_point' => 'required',
      ]);

      $booking = new BookingHistory();
      $booking->user = $request->get('name');
      $booking->pnr_number = $request->get('Pnrnumber');
      $booking->jounary_date = $request->get('Jourany_date');
      $booking->trip = $request->get('pickuppoint');
      $booking->pick_up_point = $request->get('dropping_point');
      $booking->dropping_point = $request->get('trip');
      $booking->status = $request->get('status');
       $booking->fare = 10;
      $booking->status = true;
      $booking->save();
      if ($booking) {
         return Redirect::to('/admin/booking_history/')->with('message', 'Booking History Addedd Successfully');
      }
   }

   public  function bookinghistorylist(Request $request)
   {
     $columns = array(
         1 => 'user',
         2=>'jounary_date',
         3=>'trip',
         7 => 'created_at',

      );

      $column = $request->input('order.0.column');
      $dir = $request->input('order.0.dir');
      $sort = $columns[$column];
      $request->sortBy = $sort;
      $request->sortType = $dir;
      $result = BookingHistory::getList($request);
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
            $editUrl = route('admin.bookinghistory-edit', $post->id);
            $editBtn = "";
            $deleteBtn = "";
            $editBtn = "<a href='$editUrl' class='btn btn-success btn-sm action_button' >
                                 <i class='fa fa-pencil-alt'></i> Edit                                 
                             </a>";
               "<span></span>";
              $deleteBtn = "<a href='javascript:void(0)' class =' btn btn-danger btn-sm deleteEntry' data-id='$post->id'>
                                 <i class='fa fa-trash-alt'></i>  
                                 Delete                                    
                             </a>";

            $datas['id'] = $i;
            $datas['name'] = $post->user;
            $datas['jounary_date'] = $post->jounary_date;
            $datas['trip'] = $post->jounary_date;
            $datas['pick_up_point'] = $post->pick_up_point;
            $datas['dropping_point'] = $post->dropping_point;
            $datas['ticket_count'] = count($result);
             $datas['created_at'] = date('d F, Y', strtotime($post->created_at));
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
      $booking = BookingHistory::find($id);
      return view('admin.BookingHistory.edit')->with(['data' => $booking]);
   }

   public function update(Request $request)
   {
      $request->validate([
         'name' => 'required',
         'Pnrnumber' => 'required',
         'Jourany_date' => 'required',
         'trip' => 'required',
         'pickuppoint' => 'required',
         'dropping_point' => 'required',
      ]);

      $booking = BookingHistory::find($request->get('id'));
      $booking->user = $request->get('name');
       $booking->jounary_date = $request->get('Jourany_date');
      $booking->trip = $request->get('pickuppoint');
      $booking->pick_up_point = $request->get('dropping_point');
      $booking->dropping_point = $request->get('trip');
      $booking->status = $request->get('status');
      $booking->fare = 10;
      $booking->status = true;
      $booking->save();
      if ($booking) {
         return Redirect::to('/admin/bookinghistory/')->with('message', 'Booking History Update Successfully');
      }
   }

   public function delete(Request $request)
   {
      $booking = BookingHistory::where('id', $request->get('id'))->delete();
      if ($booking) {
         return response(['msg', 'Booking History Delete Successfully', 'status' => 1]);
      }
   }
}
