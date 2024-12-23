<?php

namespace App\Livewire\Notification;

use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateNotificationModal extends Component
{
    public $notification_id;

    public $status;

    public $notification_type;

    public $name;

    public $subject;

    public $content;

    public $trigger_type;

    public $trigger_day;

    public $bcc;

    protected $rules = [
        'status' => 'required|in:active,inactive',
        'notification_type' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'content' => 'required|string',
        'trigger_type' => 'nullable|string|max:255',
        'trigger_day' => 'nullable|integer|min:0',
        'bcc' => 'nullable|email|max:255',
    ];

    protected $listeners = ['modal.show.update_notification' => 'loadNotification'];

    public function render()
    {
        return view('livewire.notifications.update-notification-modal');
    }

    public function resetFields()
    {
        $this->notification_id = null;
        $this->status = null;
        $this->notification_type = null;
        $this->name = null;
        $this->subject = null;
        $this->content = null;
        $this->trigger_type = null;
        $this->trigger_day = null;
        $this->bcc = null;
    }

    public function loadNotification($notification_id)
    {
        $notification = Notification::find($notification_id);

        if (! $notification) {
            $this->dispatch('error', 'Notification not found.');

            return;
        }

        $this->notification_id = $notification->id;
        $this->status = $notification->status;
        $this->notification_type = $notification->notification_type;
        $this->name = $notification->name;
        $this->subject = $notification->subject;
        $this->content = $notification->content;
        $this->trigger_type = $notification->trigger_type;
        $this->trigger_day = $notification->trigger_day;
        $this->bcc = $notification->bcc;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            $notification = Notification::find($this->notification_id);

            if (! $notification) {
                $this->dispatch('error', 'Notification not found.');

                return;
            }

            $notification->update([
                'status' => $this->status,
                'notification_type' => $this->notification_type,
                'name' => $this->name,
                'subject' => $this->subject,
                'content' => $this->content,
                'trigger_type' => $this->trigger_type,
                'trigger_day' => $this->trigger_day,
                'bcc' => $this->bcc,
            ]);
        });

        $this->dispatch('success', 'Notification updated successfully.');
        $this->emit('refreshNotifications');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
