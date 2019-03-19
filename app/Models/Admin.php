<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property User $user
 */
class Admin extends Model
{

    public static function createUserAndTenant(array $attributes)
    {
        $admin = self::createUser($attributes);
        $userTenant = UserTenant::create([]);
        $user = $admin->user;
        $userTenant->users()->sync($user->id);
        return ['admin' => $admin, 'user_tenant' => $userTenant];
    }

    public static function createUser(array $attributes): Admin //['user' => []]
    {
        $admin = self::create([]);
        $admin->users()->create($attributes['user']);
        return $admin;
    }

    public function getUserAttribute()
    {
        return $this->users->first();
    }

    public function users()
    {
        return $this->morphToMany(User::class, 'userable');
    }
}
