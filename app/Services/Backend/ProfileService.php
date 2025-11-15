<?php

namespace App\Services\Backend;

class ProfileService
{
    public function getUser()
    {
        $user = auth()->user();

        return [
            'name'     => $user->name,
            'lastName' => $user->last_name,
            'email'    => $user->email,
        ];
    }

    public function update($data)
    {
        $user = auth()->user();

        $user->name = $data['name'] ?? $user->name;
        $user->last_name = $data['lastName'] ?? $user->last_name;
        $user->email = $data['email'] ?? $user->email;

        $user->save();

        return $user;
    }

    public function updatePassword($data)
    {
        $user = auth()->user();

        if (! empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        return $user;
    }
}
