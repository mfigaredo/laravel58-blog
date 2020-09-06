<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    /**
     * @param Post $post
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Post $post)
    {
        $this->validate(request(), [
           'photo' => 'image|max:2048',
        ]);

        $post->photos()->create([
            'url' => request()->file('photo')->store('posts','public'),
        ]);

//        Photo::create([
//            'url' => request()->file('photo')->store('posts','public'),
//            'post_id' => $post->id,
//        ]);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
//        $photoPath = str_replace('storage', 'public', $photo->url);
//        Storage::delete($photoPath);
//        Storage::disk('public')->delete($photo->url);
        return back()->with('flash', 'Foto eliminada');
    }
}
