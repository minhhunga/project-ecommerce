<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rate';
    protected $fillable = [
        'id_blog',
        'id_user',
        'rate',
    ];
}
