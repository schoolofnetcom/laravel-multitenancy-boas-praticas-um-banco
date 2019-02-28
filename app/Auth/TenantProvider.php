<?php

namespace App\Auth;


use App\Models\UserTenant;
use Illuminate\Auth\EloquentUserProvider;

class TenantProvider extends EloquentUserProvider
{
    use UserProviders;

    public static function userOrNull($user){
        return $user && $user->isType(UserTenant::class) ? $user : null;
    }
}