<?php

namespace App\Tenant;


use Illuminate\Database\Eloquent\Model;

trait TenantModels
{

    protected static function bootTenantModels()
    {
        static::addGlobalScope(new TenantScope());

        static::creating(function (Model $obj) {
            $tenantObj = \Tenant::getTenant();
            if ($tenantObj) {
                $obj->{\Tenant::getTenantField()} = $tenantObj->id;
            }
        });
    }

    public function tenant() //company tenant_id
    {
        return $this->belongsTo(\Tenant::getTenantModel(), \Tenant::getTenantField());
    }
}

//Category::all()