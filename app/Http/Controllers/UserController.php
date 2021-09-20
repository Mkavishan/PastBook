<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    /**
     * User register.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {
        try {
            // Get the facebook user.
            $facebookUser = Socialite::driver('facebook')->user();

            // Check facebook user exist on database.
            $user = User::where('facebook_user_id', $facebookUser->getId())->first();

            if (!$user) {
                $user = User::create(
                    [
                        'name' => $facebookUser->getName(),
                        'email' => $facebookUser->getEmail(),
                        'facebook_user_id' => $facebookUser->getId(),
                    ]
                );

                // Get user photos from facebook once first login.
                $url = "https://graph.facebook.com/v11.0/{$user->facebook_user_id}/photos";

                $response = Http::get(
                    $url,
                    [
                        'fields' => 'picture,likes.summary(true)',
                        'access_token' => $facebookUser->token,
                    ]
                );

                // Todo: Need to apply best photos selection mechanism.
                $count = 0;
                foreach ($response->object()->data as $image) {
                    if ($count == 9) {
                        break;
                    }

                    if ($image->likes->summary->total_count > 10) {
                        Image::create(['user_id' => $user->id, 'path' => $image->picture]);
                        $count++;
                    }
                }
            }

            // User become as authenticated user.
            Auth::login($user);

            return redirect('dashboard');

        } catch (\Exception $e) {
            return redirect('/')->with(['error' => 'Something went wrong.']);
        }
    }
}
