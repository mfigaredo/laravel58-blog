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
        $data = [
            'posts' => $category->posts()->published()->paginate(1),
            'title' => "Publicaciones de la categoria '{$category->name}'",
        ];
        return request()->wantsJson() ? $data : view('pages.home', $data);
    }
}
