<?php
/**
 * !
 *  *  this script of theme has been build by Martin Bamber (Build By Bamber) ,
 *  *  Although this code and all it's files are created by myself they are  freely available on my github page
 *
 */

namespace App\Http\traits;


trait Resources
{

    public function getresource($entity_name)
    {
        return \App\Http\Models\Resources::where("entity_name", $entity_name);
    }

    public function AllResources($entity_name, $entity_id = null)
    {
     is_null($entity_id) ? $resource = $this->getresource($entity_name)->get() : $resource = $this->getresource($entity_name)->where("entity_id",$entity_id)->get();
//     is_null($entity_id) && $resource->count() == 1 ? $resource = $resource->first();
     return $resource;
    }

}