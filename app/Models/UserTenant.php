<?php
declare(strict_types=1);

namespace App\Models;

use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User $user
 */
class UserTenant extends Model
{
    use TenantModels, Uuid;

    public static function createUser(array $attributes): UserTenant //['user' => []]
    {
        $userTenant = self::create([]);
        $userTenant->users()->create($attributes['user']);
        return $userTenant;
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
