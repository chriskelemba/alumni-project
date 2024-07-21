<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\JobPostedNotification;

class NotificationController extends Controller
{
    public function clearAll(JobPostedNotification $notification)
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
