<?php


namespace App\Http\Libraries\Pagination;


class LaravelPaginator extends Paginator
{
    public function paginate($object)
    {
        $this->set_total($object->count());

        return $object
            ->offset($this->get_limit_keys()['offset'])
            ->take($this->get_limit_keys()['limit'])
            ->get();
    }

}