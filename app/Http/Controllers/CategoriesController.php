<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
//        return $category->load('posts');
//        return $category->posts;
        return view('pages.home', [
            'title' => "Publicaciones de la categoria '{$category->name}'",
            'posts' => $category->posts()->published()->paginate(),
        ]);
    }
}
