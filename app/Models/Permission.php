<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class Permission extends Authenticatable
{
    use Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'category',
        'name',
        'code',
    ];

    protected function casts(): array
    {
        return [
        ];
    }
}
