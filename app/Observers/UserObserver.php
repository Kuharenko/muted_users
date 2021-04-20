<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function creating(User $user)
    {
        if ($user->username && $user->username[0] !== '@') {
            $user->username = '@' . $user->username;
        }

        if (!$user->username) {
            if (User::where(['username' => '@' . Str::studly($user->name)])->exists()) {
                $user->username = '@' . Str::lower(Str::studly($user->name)) . '_' . rand(1, 1000);
            } else {
                $user->username = '@' . Str::lower(Str::studly($user->name));
            }
        }
    }
}
