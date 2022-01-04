<?php

namespace Plugins\Managers;

use App\Http\Functions\Validate;

class ResourceManager
{

    public $name;
    public $type;
    public $value;
    public $resource;
    public $status;

    public function __construct(Validate $validate)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->name = $validate->Post("name");
            $this->type = $validate->Post("type");
            $this->value = $validate->Post("value");
        }
    }

    public function new($entity_name)
    {
        $this->resource = new \App\Http\Models\Resources();
        $this->resource->entity_name = $entity_name;
        $this->resource->name = $this->name;
        $this->resource->type = $this->type;
        $this->resource->value = $this->value;
        if ($this->resource->save()) {
            $this->status = true;
        } else {
            $this->status = false;
        }

    }

    public function edit($id, $entity_name)
    {

        $this->resource = \App\Http\Models\Resources::where("id", $id)->get();
        if ($this->resource->count() == 1) {
            $this->resource->entity_name = $entity_name;
            $this->resource->name = $this->name;
            $this->resource->type = $this->type;
            $this->resource->value = $this->value;
            if ($this->resource->save()) {
                $this->status = true;
            } else {
                $this->status = false;
            }
        } else {
            $this->error = "Page not found";
        }

    }

    public function override()
    {

    }

    public function delete($id)
    {

        $this->resource = \App\Http\Models\Resources::where("id", $id);
            if($this->resource->count() == 1)
            {
                $this->resource->delete();
                $this->status = true;
            }
            else
            {
                $this->status = false;
            }
    }


}