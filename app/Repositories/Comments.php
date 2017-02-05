<?php

namespace App\Repositories;

use App\Comment;
use Prettus\Repository\Criteria\RequestCriteria;

class Comments extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 根据类型返回对应模型的路径
     *
     * @param $type
     * @return string
     */
    public function getModelByType($type)
    {
        return 'App\\' . ucwords(strtolower($type));
    }
}