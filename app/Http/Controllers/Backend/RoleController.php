<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Roles\DeleteManyRoleRequest;
use App\Http\Requests\Backend\Roles\IndexRoleRequest;
use App\Http\Requests\Backend\Roles\StoreRoleRequest;
use App\Http\Requests\Backend\Roles\UpdateRoleRequest;
use App\Models\Role;
use App\Services\Backend\RoleService;
use Inertia\Inertia;

class RoleController extends Controller
{
    private $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService;
    }

    public function index(IndexRoleRequest $request)
    {
        $this->authorize('list_roles');

        $recordsPerPage = $request->recordsPerPage ?? 10;
        $tableSearch = $request->search ?? null;
        $tablePage = $request->page ?? 1;
        $tableSortByColumn = $request->sortByColumn ?? 'name';
        $tableSortByDirection = $request->sortByDirection ?? 'asc';

        $params = [
            'recordsPerPage'  => $recordsPerPage,
            'search'          => $tableSearch,
            'page'            => $tablePage,
            'sortByColumn'    => $tableSortByColumn,
            'sortByDirection' => $tableSortByDirection,
        ];

        $roles = $this->roleService->getRoles($recordsPerPage, $tableSearch, $tableSortByColumn, $tableSortByDirection, $tablePage);

        return Inertia::render('backend/roles/Index', [
            'roles'  => $roles,
            'params' => $params,
        ]);
    }

    public function create()
    {
        $this->authorize('create_roles');

        $permissions = $this->roleService->getPermissions();

        return Inertia::render('backend/roles/Create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create_roles');

        $role = $this->roleService->store($request->validated());

        return to_route('backend.roles.show', $role->id);
    }

    public function show(Role $role)
    {
        $this->authorize('view_roles');

        $role = $this->roleService->getRole($role->id);
        $permissions = $this->roleService->getPermissions();

        return Inertia::render('backend/roles/Show', [
            'role'        => $role,
            'permissions' => $permissions,
        ]);
    }

    public function edit(Role $role)
    {
        $this->authorize('edit_roles');

        $role = $this->roleService->getRole($role->id);
        $permissions = $this->roleService->getPermissions();

        return Inertia::render('backend/roles/Edit', [
            'role'        => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('edit_roles');

        $role = $this->roleService->update($request->validated(), $role);

        return back();
    }

    public function delete(Role $role)
    {
        $this->authorize('delete_role');

        try {
            $this->roleService->delete($role->id);
        } catch (\Exception $exception) {
            return back()->withErrors([$exception->getMessage()]);
        }

        return to_route('backend.roles.index');
    }

    public function deleteMany(DeleteManyRoleRequest $request, Role $role)
    {
        $this->authorize('delete_roles');

        try {
            $this->roleService->deleteMany($request->validated('roleIds'));
        } catch (\Exception $exception) {
            return back()->withErrors([$exception->getMessage()]);
        }

        return to_route('backend.roles.index');
    }
}
