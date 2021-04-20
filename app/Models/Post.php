<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'description',
        'user_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function scopeExcludeMuted($query, User $user)
    {
        $muted_users = $user->muted->pluck(['blocked_user_id'])->toArray();
        return $query->whereNotIn('user_id', $muted_users);
    }
}
