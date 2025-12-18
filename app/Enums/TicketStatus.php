<?php

namespace App\Enums;

enum TicketStatus: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case PROCESSED = 'processed';

    public static function fromValue(string $value): string
    {
        return match($value) {
            self::NEW->value => 'new',
            self::IN_PROGRESS->value => 'in_progress',
            self::PROCESSED->value => 'processed',
            default => throw new \InvalidArgumentException("Invalid ticket status value: $value"),
        };
    }

    public function getReadableName(): string
    {
        return match($this) {
            self::NEW => 'New',
            self::IN_PROGRESS => 'In Progress',
            self::PROCESSED => 'Processed',
        };
    }
}