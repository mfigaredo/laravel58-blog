<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function show(Post $post)
    {

        if($post->isPublished() || auth()->check() )
        {
            $post->load('category', 'owner', 'tags', 'photos');
            if( request()->wantsJson() ) {
                return $post;
            }
            return view('posts.show', compact('post'));
        }
        abort(404);
    }
}
