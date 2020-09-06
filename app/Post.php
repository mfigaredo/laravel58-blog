<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $dates = ['published_at'];
//    protected $guarded = [];

    protected $fillable = [
        'title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id',
    ];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public static function findByUrl($url)
    {
        return Post::where('url', '=', $url)->first();
    }

    public static function getUniqueUrl($title)
    {
        $k = "";
        do {
            $url = Str::slug($title) . $k;
            $k = empty($k) ? 1 : $k+1;
        } while( self::where('url', '=', $url)->get()->count() > 0 );
        return $url;
    }

    public static function boot()
    {
        parent::boot();
//        self::saving(function($model) {
//            $model->url = $model->url == Str::slug($model->title) ? $model->url : self::getUniqueUrl($model->title);
//        });
//        self::creating(function($model) {
//            $model->url = self::getUniqueUrl($model->title);
//        });

        static::deleting(function($post) {
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
            ->where('published_at', '<=' , Carbon::now())
            ->latest('published_at');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['url'] = Str::slug($title);
    }

    public function setPublishedAtAttribute($published_at)
    {
//        dd($published_at);
//        $this->attributes['published_at'] = $published_at;
//        $this->attributes['published_at'] = $published_at !== null ? Carbon::createFromFormat('!d/m/Y', $published_at) : null;
        try {
            $this->attributes['published_at'] = Carbon::createFromFormat('!d/m/Y', $published_at);

        } catch(\Exception $e) {
            $this->attributes['published_at'] = null;
        }
    }

    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category)
            ? $category
            : Category::create(['name' => $category])->id;
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function($tag){
           return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });
        return $this->tags()->sync($tagIds);
    }
}
