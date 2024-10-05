<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
// use Illuminate\Http\Request;
use App\Models\ImageForPost;
use App\Models\Post;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    public function list(): Collection
    {
        return Post::all();
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'content' => $request->input('content'),
            'topic' => $request->input('topic'),
            'author' => $request->user()->id ?? null
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('uploads', $imageName, 'public');

                ImageForPost::create([
                    "path" => 'uploads/' . $imageName,
                    'post_id' => $post->id
                ]);
            }
        }

        $post->load('image');

        return response()->json([
            'message' => 'Пост успешно создан',
            'post' => $post,
        ], 201);
    }
}
