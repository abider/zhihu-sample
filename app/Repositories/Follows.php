<?php

namespace App\Repositories;

use App\Follow;
use Prettus\Repository\Criteria\RequestCriteria;

class Follows extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Follow::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}