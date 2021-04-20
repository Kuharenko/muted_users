<?php

namespace App\Http\Controllers;

use App\Http\Requests\MuteRequest;
use App\Models\User;
use App\Models\UserMute;

class MuteController extends Controller
{
    public function store(MuteRequest $request)
    {
        $user_id = $request->post('user_id');
        UserMute::where('user_id', $user_id)->delete();

        $user = User::find($user_id);
        foreach ($request->post('muted') as $id) {
            $user->muted()->create([
                'blocked_user_id' => $id
            ]);
        }

        return $user->muted;
    }

    public function show(User $user)
    {
        return $user->muted;
    }
}
