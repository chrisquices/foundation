<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Permissions\IndexPermissionRequest;
use App\Models\Permission;
use App\Services\Backend\PermissionService;
use Inertia\Inertia;

class PermissionController extends Controller
{
    private $permissionService;

    public function __construct()
    {
        $this->permissionService = new PermissionService;
    }

    public function index(IndexPermissionRequest $request)
    {
        $this->authorize('list_permissions');

        $recordsPerPage = $request->recordsPerPage ?? 10;
        $tableSearch = $request->search ?? null;
        $tablePage = $request->page ?? 1;
        $tableSortByColumn = $request->sortByColumn ?? 'category';
        $tableSortByDirection = $request->sortByDirection ?? 'asc';

        $params = [
            'recordsPerPage'  => $recordsPerPage,
            'search'          => $tableSearch,
            'page'            => $tablePage,
            'sortByColumn'    => $tableSortByColumn,
            'sortByDirection' => $tableSortByDirection,
        ];

        $permissions = $this->permissionService->getPermissions($recordsPerPage, $tableSearch, $tableSortByColumn, $tableSortByDirection, $tablePage);

        return Inertia::render('backend/permissions/Index', [
            'permissions'  => $permissions,
            'params'       => $params,
        ]);
    }

    public function show(Permission $user)
    {
        $this->authorize('view_permissions');

        $user = $this->permissionService->getPermission($user->id);

        return Inertia::render('backend/permissions/Show', [
            'user'            => $user,
        ]);
    }
}
