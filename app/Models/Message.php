<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function messages()
    {
    return $this->hasMany(Message::class);
    }

    public function parent()
    {
        /* return $this->belongsTo(Message::class, 'parent_id'); */
        return $this->belongsTo(Message::class, 'parent_id')->default(null);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    } 
}
