<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'name_message',
        'receiver_id',
        'content_message',
        'reply_parent'];
    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $model->sender_id = auth()->user()->id;
        });
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function subMessages()
    {
        return $this->hasMany(Message::class, 'reply_parent');
    }



}
