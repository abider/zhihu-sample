<?php

namespace App\Repositories;

use App\Answer;
use Prettus\Repository\Criteria\RequestCriteria;

class Answers extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Answer::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 检索未隐藏的答案
     *
     * @return mixed
     */
    public function published()
    {
        return $this->model->where('is_hidden', 0);
    }
}