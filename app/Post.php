<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $dates = ['published_at'];
    protected $guarded = [];

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
        self::saving(function($model) {
            $model->url = $model->url == Str::slug($model->title) ? $model->url : self::getUniqueUrl($model->title);
        });
        self::creating(function($model) {
            $model->url = self::getUniqueUrl($model->title);
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
}
