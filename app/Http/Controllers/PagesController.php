<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
//        $posts = Post::whereNotNull('published_at')
//                ->where('published_at', '<=' , Carbon::now())
//                ->latest('published_at')
//                ->get();
        $query = Post::published();

        if(request('month')) {
            $query->whereMonth('published_at', request('month'));
        }
        if(request('year')) {
            $query->whereYear('published_at', request('year'));
        }

        $posts = $query->paginate(5);
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
        $archive = Post::published()->byYearAndMonth()->take(20)->get();

        return view('pages.archive', [
            'authors' => User::latest()->take(4)->get(),
            'categories' => Category::latest()->take(7)->get(),
            'posts' => Post::latest('published_at')->take(20)->get(),
            'archive' => $archive,
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

}
