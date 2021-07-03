<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category_id',
        'type_post'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'=>'title'
            ]
        ];
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function attachments(){
        return $this->hasMany(Attachment::class);

    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}
