<?php

namespace App\Models;

use App\Tenant\TenantModels;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantModels, Uuid, FormAccessible;
    protected $fillable = ['name','description','price', 'category_id'];


    public function formCategoryUuidAttribute(){
        return $this->category->uuid;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

//'category_uuid'
