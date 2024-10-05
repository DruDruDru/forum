<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, HasUuids;
    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = ['content', 'topic', 'author'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function image()
    {
        return $this->hasMany(ImageForPost::class, 'post_id');
    }
}
