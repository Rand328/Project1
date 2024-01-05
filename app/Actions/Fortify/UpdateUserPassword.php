<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    protected $tempProfilePhotoUrl;
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'birthday' => ['nullable', 'date'],
            'avatar' => ['nullable', 'image', 'max:1024'],
            'about_me' => ['nullable', 'string', 'max:500'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['avatar'])) {
            $this->updateUserProfilePhoto($user, $input['avatar']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'birthday' => $input['birthday'],
                'about_me' => $input['about_me'],
            ])->save();
        }
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\UploadedFile  $photo
     */
    protected function updateUserProfilePhoto(User $user, $photo): void
    {
        $user->updateProfilePhoto($photo);
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'birthday' => $input['birthday'],
            'about_me' => $input['about_me'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    public function updateProfileInformation()
    {
        $this->validate([
            'state.name' => ['required', 'string', 'max:255'],
            'state.email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id())],
            'state.birthday' => ['nullable', 'date'],
            'state.avatar' => ['nullable', 'image', 'max:1024'],
            'state.about_me' => ['nullable', 'string', 'max:500'],
        ]);

        if ($this->state['avatar']) {
            $avatarPath = $this->state['avatar']->store('profile-photos', 'storage/app/public');
            Log::info('Avatar stored at: ' . $avatarPath);
            $this->user->update(['profile_photo_path' => $avatarPath]);
            $this->tempProfilePhotoUrl = $this->state['avatar']->temporaryUrl();
        }

        app(UpdateUserProfileInformation::class)->update(auth()->user(), $this->state);

        $this->emit('saved'); // This emits a message to indicate that the profile information has been saved successfully
    }

    public function getTempProfilePhotoUrl()
    {
        return $this->tempProfilePhotoUrl;
    }

}