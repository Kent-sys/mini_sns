<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //ユーザーが投稿した記事一覧
    public function articles(): HasMany{
        return $this->hasMany('App\Article');
    }
    //ユーザーがいいねした記事一覧
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Article', 'likes')->withTimestamps();
    }
    //どのユーザーからフォローされているか
    public function followers() :BelongsToMany{
        return $this->belongsToMany('App\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }
    //どのユーザーをフォローorフォロー解除するか
    public function following() :BelongsToMany{
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    public function isFollowedBy(?User $user): bool{
        return $user ? (bool)$this->followers->where('id', $user->id)->count()
                     : false;
    }

    //フォローされているユーザー数を取得
    public function getCountFollowersAttribute(): int{
        return $this->followers->count();
    }

    //フォローしているユーザー数を取得
    public function getCountFollowingAttribute(): int{
        return $this->following->count();
    }
}
