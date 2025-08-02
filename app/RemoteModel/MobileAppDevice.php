<?php

namespace App\RemoteModel;

class MobileAppDevice
{
    // Some other attributes
    public string|null $type;

    // Constructor
    public function __construct(
        protected int $id,
        protected string|null $ios_token,
        protected string|null $android_token,
    )
    {
        if ($ios_token !== null) {
            $this->type = 'ios';
        } elseif ($android_token != null) {
            $this->type = 'android';
        } else {
            $this->type = null;
        }
    }

    static function fromJson(array $data): self
    {
        return new self(
            $data['id'],
            $data['ios_token'],
            $data['android_token'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'ios_token' => $this->ios_token,
            'android_token' => $this->android_token,
        ];
    }

}