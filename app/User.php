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

    public function votes()
    {
        return $this->belongsToMany(Answer::class, 'votes');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'to_user_id');
    }

    /**
     * 用户关注的问题
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questionFollowers()
    {
        return $this->belongsToMany(Question::class, 'user_question');
    }

    /**
     * 用户关注的人
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userFollowers()
    {
        return $this->belongsToMany(self::class, 'followers', 'follower_id', 'followed_id');
    }

    /**
     * 用户被关注的人
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userFolloweds()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'follower_id');
    }

    /**
     * 重写发送密码重置邮件逻辑
     *
     * @param string $token
     */
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
        return $this->questionFollowers()->toggle($id);
    }

    /**
     * 用户关注另一个用户
     *
     * @param $id   user_id
     * @return array
     */
    public function followUser($id)
    {
        return $this->userFollowers()->toggle($id);
    }

    /**
     * 用户对一个答案点赞
     *
     * @param $id   answer_id
     * @return array
     */
    public function voteForAnswer($id)
    {
        return $this->votes()->toggle($id);
    }

    /**
     * 判断用户是否关注了这个问题
     *
     * @param $id   question_id
     * @return bool
     */
    public function isFollowedQuestion($id)
    {
        return $this->questionFollowers()->where('question_id', $id)->count() > 0;
    }

    /**
     * 判断当前用户是否关注了这个用户
     *
     * @param $id   user_id
     * @return bool
     */
    public function isFollowedUser($id)
    {
        return $this->userFollowers()->where('followed_id', $id)->count() > 0;
    }

    /**
     * 判断当前用户是否点赞了这个答案
     *
     * @param $id   answer_id
     * @return bool
     */
    public function isVoteAnswer($id)
    {
        return $this->votes()->where('answer_id', $id)->count() > 0;
    }
}
