<?php


namespace App\Services;


use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class CacheService
{
    const SIZE = 50;
    public static function posts(User $user, string $mode, int $page = 1)
    {
        $cache_key = $user->username; // not ID     :)
        $part = $cache_key . '_' . $mode . '_' . $page;
        if (!Redis::hexists('posts', $part)) {

            switch ($mode) {
                case 'random':
                    return Post::excludeMuted($user)->inRandomOrder()->limit(self::SIZE)->get();
                case 'old':
                    $posts = Post::excludeMuted($user)->oldest()->limit(self::SIZE)->offset(($page -1) * self::SIZE)->get();
                    break;
                default:
                    $posts = Post::excludeMuted($user)->latest()->limit(self::SIZE)->offset(($page -1) * self::SIZE)->get();
            }

            Redis::hset('posts', $part, $posts);
        }

        return Post::hydrate(json_decode(Redis::hget('posts', $part), true));
    }
}
