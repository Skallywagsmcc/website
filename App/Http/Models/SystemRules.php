<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemRules extends \Illuminate\Database\Eloquent\Model
{



    public function GetSettings($entity_name,$id)
    {
        return $this->belongsTo(SiteSettings::class)->where("id",$id)->where("entity_name",$entity_name);
    }


}