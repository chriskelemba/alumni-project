<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\JobPostedNotification;

class NotificationController extends Controller
{
    public function markAsRead(Request $request, $notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);
    
        if ($notification) {
            $notification->markAsRead();
            $notification->update(['read' => true]);
        }
    
        return redirect()->back();
    }

    public function clearAll(JobPostedNotification $notification)
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
