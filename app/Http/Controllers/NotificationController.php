<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function show($id)
    {
        $notification = $this->notificationService->markAsRead($id);
        $url = $notification->data['url'];

        return redirect($url);
    }

    public function marksAllRead()
    {
        $this->notificationService->markAllAsRead();

        return redirect()->back()->with('success', 'Seluruh notifikasi berhasil ditandai sebagai dibaca');
    }

    public function destroy($id)
    {
        $this->notificationService->deleteNotification($id);

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus');;
    }

    public function clearAll()
    {
        $this->notificationService->clearAllNotifications();

        return redirect()->back()->with('success', 'Seluruh notifikasi berhasil dihapus');;
    }
}
