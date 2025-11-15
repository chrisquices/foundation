<?php

namespace App\Services\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

class UserService
{
    public function getUser($userId)
    {
        $user = User::find($userId);

        return [
            'id'              => $user->id,
            'name'            => $user->name,
            'lastName'        => $user->last_name,
            'email'           => $user->email,
            'isActive'        => $user->is_active,
            'roles'           => $user->roles->map(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                ];
            }),
        ];
    }

    public function getUsers(int $recordsPerPage, ?string $search = null, string $sortByColumn = 'name', string $sortByDirection = 'asc', int $page = 1)
    {
        return User::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'ilike', "%{$search}%")
                        ->orWhere('last_name', 'ilike', "%{$search}%")
                        ->orWhere('email', 'ilike', "%{$search}%");
                });
            })
            ->when($sortByColumn, fn ($q, $sortByColumn) => $q->orderBy($sortByColumn, $sortByDirection ?? 'asc'))
            ->paginate(perPage: $recordsPerPage, columns: ['*'], pageName: 'page', page: $page)
            ->through(function ($user) {
                $id = $user->id;
                $name = $user->name;
                $lastName = $user->last_name;
                $email = $user->email;
                $photo = $user->photo;
                $emailVerified = $user->email_verified_at;
                $isActive = $user->is_active;
                $isAdmin = $user->is_admin;

                return [
                    'id'              => $id,
                    'name'            => $name,
                    'lastName'        => $lastName,
                    'email'           => $email,
                    'photo'           => $photo,
                    'emailVerifiedAt' => $emailVerified,
                    'isActive'        => $isActive,
                    'isAdmin'         => $isAdmin,
                ];
            });
    }

    public function getRoles()
    {
        return Role::query()
            ->get()
            ->map(function ($role) {
                return [
                    'id'              => $role->id,
                    'name'            => $role->name,
                ];
            });
    }

    public function store($data)
    {
        $password = Str::random(8);

        $newUser = User::create([
            'name'      => $data['name'],
            'last_name' => $data['lastName'],
            'email'     => $data['email'],
            'password'  => bcrypt($password),
        ]);

        // Attach roles
        if (! empty($data['roleIds']) && is_array($data['roleIds'])) {
            $newUser->roles()->sync($data['roleIds']);
        }

        // TODO: Email the plaintext $password to the user

        return $newUser;
    }

    public function update($data, User $user)
    {
        $user->name = $data['name'] ?? $user->name;
        $user->last_name = $data['lastName'] ?? $user->last_name;
        $user->email = $data['email'] ?? $user->email;

        $user->save();

        // Attach roles
        if (! empty($data['roleIds']) && is_array($data['roleIds'])) {
            $user->roles()->sync($data['roleIds']);
        }

        return $user;
    }

    public function delete($userId)
    {
        $thisUser = auth()->user();

        if ($thisUser->id === $userId) { // Throw error in case user is trying to delete self
            return 'error'; // TODO create exception
        }

        $user = User::findOrFail($userId);

        // Delete preferences
        $user->preferences()->delete();

        // Delete user
        $user->delete();
    }

    public function deleteMany($userIds)
    {
        $thisUser = auth()->user();

        if (in_array($thisUser->id, $userIds, true)) { // Throw error in case user is trying to delete self
            return 'error'; // TODO create exception
        }

        foreach ($userIds as $userId) {
            $this->delete($userId);
        }
    }

    public function activate($userId)
    {
        $user = User::findOrFail($userId);
        $user->update(['is_active' => true]);
    }

    public function deactivate($userId)
    {
        $user = User::findOrFail($userId);
        $user->update(['is_active' => false]);
    }
}
