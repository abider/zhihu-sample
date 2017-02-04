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

    public function withTopicsById($id)
    {
        return $this->with('topics')->find($id);
    }

    /**
     * 检索未隐藏的问题
     *
     * @return mixed
     */
    public function published()
    {
        return $this->model->where('is_hidden', 0);
    }
}