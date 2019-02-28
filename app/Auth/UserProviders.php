<?php

namespace App\Auth;


trait UserProviders
{
    public function retrieveById($identifier)
    {
        $user = parent::retrieveById($identifier);
        return static::userOrNull($user);
    }

    public function retrieveByToken($identifier, $token)
    {
        $user = parent::retrieveByToken($identifier, $token);
        return static::userOrNull($user);
    }

    public function retrieveByCredentials(array $credentials)
    {
        $user = parent::retrieveByCredentials($credentials);
        return static::userOrNull($user);
    }
}