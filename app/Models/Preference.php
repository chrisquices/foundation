<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class Preference extends Authenticatable
{
    use Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'user_id',
        'theme',
    ];
}
