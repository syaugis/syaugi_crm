<?php

namespace App\Services;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    public function markAsRead($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->markAsRead();

        return $notification;
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function deleteNotification($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->delete();
    }

    public function clearAllNotifications()
    {
        DatabaseNotification::where('notifiable_id', Auth::id())->delete();
    }
}
