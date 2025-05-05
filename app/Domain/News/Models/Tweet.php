<?php

namespace App\Domain\News\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['tweet_id', 'text', 'url', 'source', 'account_id', 'posted_at'];

    public $timestamps = ['posted_at'];

    public function account()
    {
        return $this->hasOne(Account::class);
    }
}
