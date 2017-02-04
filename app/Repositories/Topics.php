<?php

namespace App\Repositories;

use App\Topic;
use Prettus\Repository\Criteria\RequestCriteria;

class Topics extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Topic::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 格式化由select2传递过来的Topic数组，统一返回ID
     *
     * @param array $topics
     * @return array
     */
    public function normaleze(array $topics)
    {
        return collect($topics)->map(function ($topic) {
            if (is_numeric($topic)) {
                $this->find($topic)->increment('questions_count');
                return (int) $topic;
            }

            $newTopic = $this->create([
                'name' => $topic,
                'questions_count' => 1
            ]);

            return $newTopic->id;
        })->toArray();
    }
}