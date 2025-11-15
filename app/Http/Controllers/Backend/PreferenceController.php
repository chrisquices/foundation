<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\Preferences\UpdatePreferenceRequest;
use App\Services\Backend\PreferenceService;

class PreferenceController extends Controller
{
    private $permissionService;

    public function __construct()
    {
        $this->permissionService = new PreferenceService;
    }

    public function update(UpdatePreferenceRequest $request)
    {
        $name = $request->validated()['name'];
        $value = $request->validated()['value'];

        $this->permissionService->update($name, $value);

        return back();
    }
}
