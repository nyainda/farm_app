<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CalendarController extends Controller {
    public function index() {
        return view('calendar');
    }

    public function events() {
        // Fetch events from your database and return as JSON
        $events = Event::all();
        return response()->json($events);
    }
}
