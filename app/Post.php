<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'author', 'slug', 'category_id', 'public'];

    public function category() {
      return $this->belongsTo('App\Category');
    }

    public function tags() {
      return $this->belongsToMany('App\Tag');
    }

    public function scopeIsPublic($query)
    {
        return $query->where('public', 1);
    }

    public function scopeByAuthor($query, $author) {
        return $query->where('author', $author);
    }
}
