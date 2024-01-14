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
    public function update(Request $request, $user)
    {
        $user = User::findOrFail($user);

        // Validate and update user data
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'about_me' => 'nullable|string|max:500',
           
        ]);

        $user->update([
            'name' => $request->input('name'),
            'birthday' => $request->input('birthday'),
            'about_me' => $request->input('about_me'),
           
        ]);
        $this->emit('saved'); 
        return redirect()->route('user.profile', $user);
    }
}
