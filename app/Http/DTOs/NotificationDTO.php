<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class NotificationDTO extends DTO
{
    public function __construct(
        private readonly ?string $status,
        private readonly string $notificationType,
        private readonly string $name,
        private readonly ?string $subject,
        private readonly string $content,
        private readonly string $triggerType,
        private readonly int $triggerDay,
        private readonly ?string $bcc,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('status', null),
            $request->get('notification_type'),
            $request->get('name'),
            $request->get('subject', null),
            $request->get('content'),
            $request->get('trigger_type'),
            $request->get('trigger_day'),
            $request->get('bcc', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['status'] ?? null,
            $data['notification_type'],
            $data['name'],
            $data['subject'] ?? null,
            $data['content'],
            $data['trigger_type'],
            $data['trigger_day'],
            $data['bcc'] ?? null,
        );
    }
}
