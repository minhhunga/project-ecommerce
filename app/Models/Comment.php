<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $fillable = [
        'comment',
        'id_user',
        'id_blog',
        'name_user',
        'avatar_user',
        'level',
        'time',
    ];
}
