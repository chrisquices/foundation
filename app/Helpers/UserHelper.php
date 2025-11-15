<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class UserHelper
{
    /**
     * Check if the given user ID belongs to the currently authenticated user.
     *
     * @param int|string|null $userId
     * @return bool
     */
    public static function isOwnUser($userId): bool
    {
        $authId = Auth::id();

        if ($authId === null) {
            return false;
        }

        return (int) $authId === (int) $userId;
    }
}
