<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceCategories extends Model
{

    public function Resources()
    {
        return $this->hasMany(Resource::class,"resource_id","id")->get();
    }
}
