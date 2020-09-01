<?php

use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Category::truncate();
        Tag::truncate();
        $tag1 = new Tag;
        $tag1->name = 'Etiqueta1';
        $tag1->save();
        $tag2 = new Tag;
        $tag2->name = 'Etiqueta2';
        $tag2->save();
        $tag3 = new Tag;
        $tag3->name = 'Etiqueta3';
        $tag3->save();

        $category = new Category;
        $category->name = 'Categoría UNO';
        $category->save();
        $category = new Category;
        $category->name = 'Categoría DOS';
        $category->save();

        $post = new Post;
        $post->title = 'Mi Primer Post';
//        $post->url = Str::slug($post->title);
        $post->excerpt = 'Extracto del primer post';
        $post->body = '<p>Contenido del primer post</p>';
        $post->published_at = Carbon::now()->subDays(4);
        $post->category_id = 1;
        $post->save();
        $post->tags()->attach($tag1);
        $post->tags()->attach($tag2);

        $post = new Post;
        $post->title = 'Mi Segundo Post';
//        $post->url = Str::slug($post->title);
        $post->excerpt = 'Extracto del segundo post';
        $post->body = '<p>Contenido del segundo post</p>';
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 1;
        $post->save();
        $post->tags()->attach($tag2);
        $post->tags()->attach($tag3);

        $post = new Post;
        $post->title = 'Mi Tercer Post';
//        $post->url = Str::slug($post->title);
        $post->excerpt = 'Extracto del tercer post';
        $post->body = '<p>Contenido del tercer post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 2;
        $post->save();
        $post->tags()->attach($tag1);
        $post->tags()->attach($tag3);

        $post = new Post;
        $post->title = 'Mi Cuarto Post';
//        $post->url = Str::slug($post->title);
        $post->excerpt = 'Extracto del cuarto post';
        $post->body = '<p>Contenido del cuarto post</p>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id = 2;
        $post->save();
        $post->tags()->attach($tag2);



    }
}
