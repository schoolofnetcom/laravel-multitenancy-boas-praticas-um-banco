<?php

namespace App\Models;

use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;

class UserTenant extends Model
{
    use TenantModels;

    public static function createUser(array $attributes) //['user' => []]
    {
        $admin = self::create([]);
        $admin->user()->create($attributes['user']);
        return $admin;
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
