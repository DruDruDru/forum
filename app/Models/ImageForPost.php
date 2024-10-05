<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageForPost extends Model
{
    use HasFactory;

    protected $primaryKey = 'path';
    public $incrementing = false;
    protected $keyType = 'text';

    protected $table = 'images_for_posts';

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    protected $fillable = ['path', 'post_id'];
}
