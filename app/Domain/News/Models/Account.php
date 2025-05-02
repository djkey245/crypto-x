<?php

namespace App\Domain\News\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['nickname', 'type'];

    public const TYPES = [
        'investor', 'project', 'educational', 'analytical'
    ];
}
