<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMute extends Model
{
    protected $table = 'user_mute';

    protected $fillable = [
        'blocked_user_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
