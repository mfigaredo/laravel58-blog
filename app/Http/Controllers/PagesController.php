<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
//        $posts = Post::whereNotNull('published_at')
//                ->where('published_at', '<=' , Carbon::now())
//                ->latest('published_at')
//                ->get();
        $posts = Post::published()->paginate(5);
//        dd($posts);
        return view('pages.home', compact('posts'));
    }

//    public function show(Post $post)
//    {
//        dd($post);
//    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        return view('pages.archive');
    }

    public function contact()
    {
        return view('pages.contact');
    }

}
