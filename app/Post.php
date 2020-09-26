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
        'title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id', 'user_id',
    ];

    protected $appends = ['published_date'];
//    protected $with = ['category', 'tags', 'owner', 'photos'];

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

        static::creating(function($post) {
            if(!$post->user_id)
                $post->user_id = auth()->check() ? auth()->id() : null;
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
        $query->with(['category', 'tags', 'owner', 'photos'])
            ->whereNotNull('published_at')
            ->where('published_at', '<=' , Carbon::now())
            ->latest('published_at');
    }

    public function scopeAllowed($query)
    {
        if( auth()->user()->can('view', $this) ) {
            return $query;
        }
        return $query->where('user_id', auth()->id());
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

//    public function setTitleAttribute($title)
//    {
//        $this->attributes['title'] = $title;
//        $url = Str::slug($title);
//        if( Post::where('url', $url)->exists()) {
//            $url = $url . '-2';
//        }
//        $this->attributes['url'] = $url;
//    }

    public function setPublishedAtAttribute($published_at)
    {
//        dd($published_at);
//        $this->attributes['published_at'] = $published_at;
//        $this->attributes['published_at'] = $published_at !== null ? Carbon::createFromFormat('!d/m/Y', $published_at) : null;
        try {
            $this->attributes['published_at'] = $published_at instanceof Carbon ? $published_at : Carbon::createFromFormat('!d/m/Y', $published_at);

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

    public static function create(array $attributes = [])
    {
        $post = static::query()->create($attributes);
        $post->generateUrl();
//        $post->user_id = auth()->id();
        $post->save();
        return $post;
    }

    public function generateUrl()
    {
        $url = Str::slug($this->title);
        if( $this::whereUrl($url)->exists()) {
            $url .=  "-{$this->id}";
        }
        $this->url = $url;
//        $this->save();
    }

    public function isPublished()
    {
        return !is_null($this->published_at) && $this->published_at <= today();
    }

    public function viewType($home = '')
    {

        if($this->photos->count() === 1) {
            return 'posts.photo';
        } elseif( $this->photos->count() > 1 ) {
            return $home == 'home' ? 'posts.carousel-preview' : 'posts.carousel';
        } elseif( $this->iframe) {
            return 'posts.iframe';
        }
        return 'posts.text';
    }

    public function scopeByYearAndMonth($query)
    {
        return $query->selectRaw('year(published_at) as year')
            ->selectRaw('month(published_at) as month')
            ->selectRaw('monthname(published_at) as monthname')
            ->selectRaw('count(*) as posts')
            ->groupBy('year', 'month', 'monthname')
            ->orderBy('published_at', 'DESC');
    }

    public function getPublishedDateAttribute()
    {
        return optional($this->published_at)->format('M d');
    }
}
