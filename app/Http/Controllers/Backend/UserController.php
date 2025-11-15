<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\UserHelper;
use App\Http\Requests\Backend\Users\DeleteManyUserRequest;
use App\Http\Requests\Backend\Users\IndexUserRequest;
use App\Http\Requests\Backend\Users\StoreUserRequest;
use App\Http\Requests\Backend\Users\UpdateUserRequest;
use App\Models\User;
use App\Services\Backend\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function index(IndexUserRequest $request)
    {
        $this->authorize('list_users');

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

        $users = $this->userService->getUsers($recordsPerPage, $tableSearch, $tableSortByColumn, $tableSortByDirection, $tablePage);

        return Inertia::render('backend/users/Index', [
            'users'  => $users,
            'params' => $params,
        ]);
    }

    public function create()
    {
        $this->authorize('create_users');

        $roles = $this->userService->getRoles();

        return Inertia::render('backend/users/Create', [
            'roles' => $roles,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create_users');

        $user = $this->userService->store($request->validated());

        return to_route('backend.users.show', $user->id);
    }

    public function show(User $user)
    {
        $this->authorize('view_users');

        $user = $this->userService->getUser($user->id);
        $IsOwnUser = UserHelper::isOwnUser($user['id']);

        return Inertia::render('backend/users/Show', [
            'user'      => $user,
            'isOwnUser' => $IsOwnUser,
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('edit_users');

        $user = $this->userService->getUser($user->id);
        $roles = $this->userService->getRoles();

        return Inertia::render('backend/users/Edit', [
            'user'      => $user,
            'roles'     => $roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('edit_users');

        $user = $this->userService->update($request->validated(), $user);

        return back();
    }

    public function delete(User $user)
    {
        $this->authorize('delete_user');

        try {
            $this->userService->delete($user->id);
        } catch (\Exception $exception) {
            return back()->withErrors([$exception->getMessage()]);
        }

        return to_route('backend.users.index');
    }

    public function deleteMany(DeleteManyUserRequest $request, User $user)
    {
        $this->authorize('delete_users');

        try {
            $this->userService->deleteMany($request->validated('userIds'));
        } catch (\Exception $exception) {
            return back()->withErrors([$exception->getMessage()]);
        }

        return to_route('backend.users.index');
    }

    public function activateUser(User $user)
    {
        $this->authorize('activate_users');

        $this->userService->activate($user->id);

        return back();
    }

    public function deactivateUser(User $user)
    {
        $this->authorize('deactivate_users');

        $this->userService->deactivate($user->id);

        return back();
    }
}
