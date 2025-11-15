<?php

namespace App\Services\Backend;

use App\Models\Permission;
use App\Models\User;

class PermissionService
{
    public function getPermission($permissionId)
    {
        $permission = Permission::find($permissionId);

        return [
            'id'       => $permission->id,
            'category' => $permission->category,
            'name'     => $permission->name,
            'code'     => $permission->code,
        ];
    }

    public function getPermissions(int $recordsPerPage, ?string $search = null, string $sortByColumn = 'category', string $sortByDirection = 'asc', int $page = 1)
    {
        return Permission::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'ilike', "%{$search}%");
                });
            })
            ->when($sortByColumn, fn ($q, $sortByColumn) => $q->orderBy($sortByColumn, $sortByDirection ?? 'asc'))
            ->paginate(perPage: $recordsPerPage, columns: ['*'], pageName: 'page', page: $page)
            ->through(function ($permission) {
                return [
                    'id'       => $permission->id,
                    'category' => $permission->category,
                    'name'     => $permission->name,
                    'code'     => $permission->code,
                ];
            });
    }
}
