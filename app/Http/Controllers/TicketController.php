<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets =Ticket::with(['customer','ticketType','order'])->paginate(env('PAGENATION_COUNT'));
        return view('admin.tickets.tickets', compact('tickets'));
    }
}
