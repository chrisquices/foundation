<?php

namespace App\Services\Backend;

use App\Models\Permission;
use App\Models\Role;

class RoleService
{
    public function getRole($roleId)
    {
        $role = Role::find($roleId);

        return [
            'id'                    => $role->id,
            'name'                  => $role->name,
            'permissions'           => $role->permissions->map(function ($role) {
                return $role->id;
            }),
        ];
    }

    public function getRoles(int $recordsPerPage, ?string $search = null, string $sortByColumn = 'name', string $sortByDirection = 'asc', int $page = 1)
    {
        return Role::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'ilike', "%{$search}%");
                });
            })
            ->when($sortByColumn, fn ($q, $sortByColumn) => $q->orderBy($sortByColumn, $sortByDirection ?? 'asc'))
            ->paginate(perPage: $recordsPerPage, columns: ['*'], pageName: 'page', page: $page)
            ->through(function ($role) {
                return [
                    'id'              => $role->id,
                    'name'            => $role->name,
                ];
            });
    }

    public function getPermissions()
    {
        return Permission::query()
            ->get()
            ->groupBy('category')
            ->map(function ($permissions, $category) {
                return [
                    'category'    => $category,
                    'permissions' => $permissions->map(function ($permission) {
                        return [
                            'id'   => $permission->id,
                            'name' => $permission->name,
                            'code' => $permission->code,
                        ];
                    })->values(),
                ];
            })
            ->values();
    }

    public function store($data)
    {
        $newRole = Role::create([
            'name'      => $data['name'],
        ]);

        // Attach permissions
        $newRole->permissions()->sync($data['permissionIds']);

        return $newRole;
    }

    public function update($data, Role $role)
    {
        $role->name = $data['name'] ?? $role->name;

        $role->save();

        // Attach permissions
        $role->permissions()->sync($data['permissionIds']);

        return $role;
    }

    public function delete($roleId)
    {
        $role = Role::findOrFail($roleId);

        $role->delete();
    }

    public function deleteMany($roleIds)
    {
        foreach ($roleIds as $roleId) {
            $this->delete($roleId);
        }
    }
}
