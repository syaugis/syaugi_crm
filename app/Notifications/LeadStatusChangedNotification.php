<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LeadStatusChangedNotification extends Notification
{
    use Queueable;

    protected $lead;

    /**
     * Create a new notification instance.
     */
    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Perubahan Status Calon Pelanggan',
            'message' => "Status {$this->lead->name} telah berubah menjadi {$this->lead->formatted_status}.",
            'url' => route('admin.lead.edit', $this->lead->id),
        ];
    }
}
