<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function spa()
    {
        return view('pages.spa');
    }

    public function home()
    {
//        $posts = Post::whereNotNull('published_at')
//                ->where('published_at', '<=' , Carbon::now())
//                ->latest('published_at')
//                ->get();
        $query = Post::published();

        $title = '';
        if(request('month')) {
            $query->whereMonth('published_at', request('month'));
            $monthName = Carbon::create(request('year'), request('month'), 1)->locale('es_ES')->monthName;
            $title .= ucwords($monthName) . ' ';
        }
        if(request('year')) {
            $query->whereYear('published_at', request('year'));
            $title .= request('year');
        }

        $data = [
            'posts' => $query->paginate(2),
            'title' =>  $title ? 'Publicaciones de ' . $title : '',
        ];
        return request()->wantsJson() ? $data :  view('pages.home', $data);
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
        $data = [
            'authors' => User::latest()->take(4)->get(),
            'categories' => Category::latest()->take(7)->get(),
            'posts' => Post::latest('published_at')->take(20)->get(),
            'archive' => Post::published()->byYearAndMonth()->take(20)->get(),
        ];
        return request()->wantsJson() ? $data : view('pages.archive', $data);
    }

    public function contact()
    {
        return view('pages.contact');
    }

}
