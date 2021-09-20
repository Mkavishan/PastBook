<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /**
     * For store new image.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $user = Auth::user();
            $path = $request->file('image')->store('photos');
            Image::create(['user_id' => $user->id, 'path' => $path]);

            $message['message'] = 'Successfully uploaded';
        } else {
            $message['error'] = 'Sorry. We are unable to process your request.';
        }

        return redirect('dashboard')->with($message);
    }

    /**
     * For edit image.
     *
     * @param Request $request
     * @param Image $image
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request, Image $image)
    {
        if ($image && $request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('photos');
            $image->path = $path;
            $image->save();

            $message['message'] = 'Successfully added';
        } else {
            $message['error'] = 'Sorry. We are unable to process your request.';
        }

        return redirect('dashboard')->with($message);
    }
}
