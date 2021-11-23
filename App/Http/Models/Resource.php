<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{

    public function Category()
    {
        return $this->belongsTo(ResourceCategories::class,"resource_id","id");
    }

}