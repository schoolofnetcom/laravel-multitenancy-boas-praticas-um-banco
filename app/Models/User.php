<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function createAdmin(array $attributes)
    {
        $user = self::create($attributes);
        $admin = Admin::create([]);
        $user->userable()->associate($admin);
        return $user;
    }

    public static function createUserTenant(array $attributes)
    {
        $user = self::create($attributes);
        $admin = UserTenant::create([]);
        $user->userable()->associate($admin);
        return $user;
    }

    public function isType($typeClass){
        return $this->userable instanceof $typeClass;
    }

    public function fill(array $attributes)
    {
        !isset($attributes['password']) ?: $attributes['password'] = bcrypt($attributes['password']);
        return parent::fill($attributes);
    }

    public function userable()
    {
        return $this->morphTo();
    }
}