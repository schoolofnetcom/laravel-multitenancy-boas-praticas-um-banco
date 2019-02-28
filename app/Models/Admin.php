<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public static function createUser(array $attributes) //['user' => []]
    {
        $admin = self::create([]);
        $admin->user()->create($attributes['user']);
        return $admin;
    }

    public function user(){
        return $this->morphOne(User::class, 'userable');
    }
}
