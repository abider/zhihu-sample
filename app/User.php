<?php

namespace App;

use App\Mail\ForgotPassword;
use Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function questionFollows()
    {
        return $this->belongsToMany(Question::class, 'user_question');
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ForgotPassword($this, $token));
    }

    /**
     * 判断是否是问题的提问者
     *
     * @param Model|integer $model
     * @return bool
     */
    public function isAuthor($model)
    {
        $user_id = is_numeric($model) ? $model : $model->user_id;

        return $this->id == $user_id;
    }

    /**
     * 用户关注问题
     *
     * @param $id   question_id
     * @return array
     */
    public function followQuestion($id)
    {
        return $this->questionFollows()->toggle($id);
    }

    /**
     * 判断用户是否关注了这个问题
     *
     * @param $id   question_id
     * @return bool
     */
    public function followed($id)
    {
        return $this->questionFollows()->where('question_id', $id)->count() > 0;
    }
}
