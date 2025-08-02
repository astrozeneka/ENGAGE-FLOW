<?php

namespace App\RemoteModel;

class MobileAppUser
{

    // Constructor
    public function __construct(
        protected int $id,
        protected string $firstname,
        protected string $lastname,
        protected string $email,
        protected array $devices,
        protected array $activities
    )
    {
    }

    static function fromJson(array $data): self
    {
        $devices = array_map(function ($device) {
            return MobileAppDevice::fromJson($device);
        }, $data['devices']);
        $activities = array_map(function ($activity) {
            return MobileAppActivity::fromJson($activity);
        }, $data['activities']);
        return new self(
            $data['id'],
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            $devices,
            $activities
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'devices' => array_map(function ($device) {
                return $device->toArray();
            }, $this->devices),
            'activities' => array_map(function ($activity) {
                return $activity->toArray();
            }, $this->activities),
        ];
    }

}