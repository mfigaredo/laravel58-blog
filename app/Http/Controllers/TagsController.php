<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        $data = [
            'title' => "Publicaciones de la etiqueta '{$tag->name}'",
            'posts' => $tag->posts()->published()->paginate(1),
        ];

        return request()->wantsJson() ? $data : view('pages.home',$data);
    }
}
