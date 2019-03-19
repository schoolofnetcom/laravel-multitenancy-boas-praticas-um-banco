<?php

namespace App\Models;


trait Uuid
{
    protected static function bootUuid()
    {
        static::creating(function ($obj) {
            $obj->uuid = \Ramsey\Uuid\Uuid::uuid4();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}