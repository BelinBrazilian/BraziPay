<?php

namespace App\Livewire\Notification;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class AddNotificationModal extends Component
{
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

    public function render()
    {
        return view('livewire.notifications.add-notification-modal');
    }

    public function resetFields()
    {
        $this->status = null;
        $this->notification_type = null;
        $this->name = null;
        $this->subject = null;
        $this->content = null;
        $this->trigger_type = null;
        $this->trigger_day = null;
        $this->bcc = null;
    }

    public function submit()
    {
        $this->validate();

        DB::transaction(function () {
            Notification::create([
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

        $this->dispatch('success', 'Notification added successfully.');
        $this->resetFields();
        $this->emit('refreshNotifications');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
