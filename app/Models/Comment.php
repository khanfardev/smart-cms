<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['name','comment','post_id','user_id'];

    public function post(){
        $this->belongsTo(Post::class );
    }
}
