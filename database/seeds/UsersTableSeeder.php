<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    private $password = 'secret';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $self = $this;
        factory(\App\Models\User::class, 1)
            ->make([
                'email' => 'admin@user.com',
            ])->each(function ($user) use($self){
                \App\Models\Admin::createUser([
                    'user' => $user->toArray() + ['password' => $self->password]
                ]);
            });

        \Tenant::setTenant(Company::find(2));
        factory(\App\Models\User::class, 1)
            ->make([
                'email' => 'user1@user.com',
            ])->each(function ($user) use($self){
                \App\Models\UserTenant::createUser([
                    'user' => $user->toArray() + ['password' => $self->password]
                ]);
            });

        \Tenant::setTenant(Company::find(3));
        factory(\App\Models\User::class, 1)
            ->make([
                'email' => 'user2@user.com',
            ])->each(function ($user) use($self){
                \App\Models\UserTenant::createUser([
                    'user' => $user->toArray() + ['password' => $self->password]
                ]);
            });
    }
}
