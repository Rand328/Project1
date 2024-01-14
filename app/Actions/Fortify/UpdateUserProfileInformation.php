<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Log;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    
  //  use WithFileUploads;

    public $photo;

    public $user;
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
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'birthday' => ['nullable', 'date'],
            'about_me' => ['nullable', 'string', 'max:500'],
            //'profile_photo_path' => ['nullable', 'image', 'max:1024'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            ])->validateWithBag('updateProfileInformation');


        if (isset($input['photo'])) {
            $photoPath = $input['photo']->store('photos', 'public');
            $user->update(['profile_photo_path' => $photoPath]);

            // Log::info($photoPath);
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
    /** protected function updateUserProfilePhoto(User $user, $photo): void
   * {
      *  $user->profile_photo_path = $photo->store('profile-photos', 'public');
       * $user->save();
   * }*/

    public function mount(User $user)
    {
        $this->user = $user;
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
            'email_verified_at' => null,
            'birthday' => $input['birthday'],
            'about_me' => $input['about_me'],
        ])->save();

        $user->sendEmailVerificationNotification();
    }
    
}