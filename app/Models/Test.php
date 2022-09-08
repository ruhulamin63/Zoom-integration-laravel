<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public $fillable = [
            'user_id',
            'meeting_id',
            'topic',
            'start_time',
            'duration',
            'password',
            'start_url',
            'join_url',
        ];

    use HasFactory;
}
