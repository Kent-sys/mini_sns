<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{

    protected $fillable = [
        'title',
        'body',
    ];
    //記事を書いたUserモデルと紐づけ
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    //中間テーブルlikesを使って、Uesrモデルと紐づけ
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    //あるユーザーがいいね済みかどうかを判定
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }
    //いいねされた数を取得
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }
    
}
