<?php


namespace App\Services;


use App\Models\User;

class SearchPostService
{
    public static function search(array $params)
    {
        $user = User::find($params['user_id']);
        $page = isset($params['page']) && $params['page'] >= 1 ? $params['page'] : 1;

        return CacheService::posts($user, $params['sort_by'] ?? 'new', $page);
    }
}
