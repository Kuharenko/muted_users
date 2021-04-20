<?php

namespace App\Observers;

use App\Models\UserMute;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class UserMuteObserver
{
    /**
     * Handle the UserMute "created" event.
     *
     * @param \App\Models\UserMute $userMute
     * @return void
     */
    public function created(UserMute $userMute)
    {
        $this->invalidateCache($userMute);
    }

    /**
     * Handle the UserMute "updated" event.
     *
     * @param \App\Models\UserMute $userMute
     * @return void
     */
    public function updated(UserMute $userMute)
    {
        $this->invalidateCache($userMute);
    }

    /**
     * Handle the UserMute "deleted" event.
     *
     * @param \App\Models\UserMute $userMute
     * @return void
     */
    public function deleted(UserMute $userMute)
    {
        $this->invalidateCache($userMute);
    }

    /**
     * Handle the UserMute "restored" event.
     *
     * @param \App\Models\UserMute $userMute
     * @return void
     */
    public function restored(UserMute $userMute)
    {
        $this->invalidateCache($userMute);
    }

    /**
     * Handle the UserMute "force deleted" event.
     *
     * @param \App\Models\UserMute $userMute
     * @return void
     */
    public function forceDeleted(UserMute $userMute)
    {
        $this->invalidateCache($userMute);
    }

    private function invalidateCache(UserMute $userMute)
    {
        $user = $userMute->user;
        $needle_key = $user->username . '_';

        $keys = Redis::hkeys('posts');
        foreach ($keys as $key) {
            if (Str::startsWith($key, $needle_key)) {
                Redis::hdel('posts', $key);
            }
        }
    }
}
