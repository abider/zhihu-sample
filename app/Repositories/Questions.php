<?php

namespace App\Repositories;

use App\Question;
use Prettus\Repository\Criteria\RequestCriteria;

class Questions extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}