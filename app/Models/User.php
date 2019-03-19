<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property Admin $admin
 * @property UserTenant $userTenant
 */
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

    public function containsType($typeClass): bool
    {
        return self
                ::query()
                ->join('userables', 'userables.user_id', '=', 'users.id')
                ->where('userable_type', $typeClass)
                ->where('users.id', $this->id)
                ->count() == 1;
    }

    public function fill(array $attributes)
    {
        !isset($attributes['password']) ?: $attributes['password'] = bcrypt($attributes['password']);
        return parent::fill($attributes);
    }

    public function getAdminAttribute()
    {
        return $this->admins->first();
    }

    public function admins()
    {
        return $this->morphedByMany(Admin::class, 'userable');
    }

    public function getUserTenantAttribute()
    {
        return $this->userTenants->first();
    }

    public function userTenants()
    {
        return $this->morphedByMany(UserTenant::class, 'userable');
    }
}