<?php

namespace App\RemoteModel;

class MobileAppActivity
{
    // Constructor
    public function __construct(
        protected int $id,
        protected string $date,
        protected int $hour
    )
    {
    }

    static function fromJson(array $data): self
    {
        return new self(
            $data['id'],
            $data['activity_date'],
            $data['activity_hour']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'hour' => $this->hour,
        ];
    }
}