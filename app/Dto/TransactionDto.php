<?php

namespace App\Dto;

class TransactionDto
{
    public ?string $id = null;
    public ?string $user_id = null;
    public ?string $room_id = null;
    public ?string $start = null;
    public ?string $end = null;
    public ?string $registered = null;
    public ?string $status = null;
}
