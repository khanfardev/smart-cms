<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'=>'name'
            ]
        ];
    }
    public function posts(){
        $this->hasMany(Post::class,'category_id');
    }
}
