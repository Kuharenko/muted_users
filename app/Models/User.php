<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'username',
    ];

    public function muted()
    {
        return $this->hasMany(UserMute::class, 'user_id', 'id');
    }
}
