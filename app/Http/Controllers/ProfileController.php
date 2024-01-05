<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the form for editing the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  UpdateUserProfileInformation  $updateUserProfileInformation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, UpdateUserProfileInformation $updateUserProfileInformation)
    {
        $this->authorize('update', $request->user());

        // Validate and update the user's profile information
        $updateUserProfileInformation->update($request->user(), $request->all());

        // Log the avatar storage path
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('profile-photos', 'public');
            Log::info('Avatar stored at: ' . $avatarPath);
        }

        return back()->with('success', 'Profile information updated successfully.');
    }
}
