<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\StorePostRequest;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.create', compact('categories','tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required']);
        $post = Post::create(['title' => request('title')]);
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function storeBK(Request $request)
    {
//        dd(request('published_at'));
        $this->validate($request, [
            'title' => 'required|min:5',
            'body' => 'required|min:10',
            'category' => 'required',
            'excerpt' => 'required|min:5',
//            'published_at' => 'required|date',
            'tags' => 'required',
        ]);
//        return Post::create($request->all());
        $post = new Post;
        $post->title = request('title');
//        $post->url = Str::slug(request('title'));
        $post->body = request('body');
        $post->excerpt = request('excerpt');

        /*try {
            $post->published_at = request('published_at') !== null ? Carbon::createFromFormat('!d/m/Y', request('published_at')) : null;

        } catch(Exception $exception) {
            $post->published_at = null;
        }*/
        dd($request);
        $post->published_at = request('published_at');
        $post->category_id = request('category');
        $post->save();

        $post->tags()->attach(request('tags'));
        return back()->with('flash','Tu publicación ha sido creada.');
     }

    public function update(Post $post, StorePostRequest $request)
    {
        $post->update($request->all());
        $post->syncTags(request('tags'));
        return redirect()->route('admin.posts.edit', $post)->with('flash','La publicación ha sido guardada.');
    }

    public function destroy(Post $post)
    {

        $post->delete();
        return redirect()
            ->route('admin.posts.index')
            ->with('flash', 'La publicación ha sido eliminada.');
    }
}
