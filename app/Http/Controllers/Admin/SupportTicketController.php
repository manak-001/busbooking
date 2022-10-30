<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    public function index($url=null)
    {
            return view('admin.SupportTicket.index');
    }

    public function create()
    {
        return view('admin.SupportTicket.add');
    }
}
