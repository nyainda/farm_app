<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function show()
    {
        $notifications = Notification::all();
        return view('notifications.pending', compact('notifications'));
    }
}
