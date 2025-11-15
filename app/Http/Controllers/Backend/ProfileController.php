<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Profile\UpdatePasswordRequest;
use App\Http\Requests\Backend\Profile\UpdateProfileRequest;
use App\Http\Requests\Backend\Users\UpdateUserRequest;
use App\Models\User;
use App\Services\Backend\ProfileService;
use Inertia\Inertia;

class ProfileController extends Controller
{
    private $profileService;

    public function __construct()
    {
        $this->profileService = new ProfileService;
    }

    public function edit(User $user)
    {
        $this->authorize('edit_profile');

        $user = $this->profileService->getUser();

        return Inertia::render('backend/profile/Edit', [
            'user'      => $user,
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $this->authorize('edit_profile');

        $user = $this->profileService->update($request->validated());

        return back();
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $this->authorize('edit_profile');

        $user = $this->profileService->updatePassword($request->validated());

        return back();
    }
}
