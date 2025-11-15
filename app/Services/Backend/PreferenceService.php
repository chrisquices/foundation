<?php

namespace App\Services\Backend;

class PreferenceService
{
    public function update($preferenceName, $value)
    {
        $user = auth()->user();

        $user->preferences->update([
            $preferenceName => $value,
        ]);
    }
}
