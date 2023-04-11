<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $query = Post::query()->with(['gallery']);

        if (($limit = (int)$request->get('limit')) && $limit > 0) {
            $query->limit($limit);
        }

        if (($offset = (int)$request->get('offset')) && $offset > 0) {
            $query->offset($offset);
        }

        return PostResource::collection($query->get());
    }

    public function show(int $id): PostResource
    {
        return PostResource::make(Post::query()->with(['gallery'])->findOrFail($id));
    }

    public function store(Request $request): \Illuminate\Database\Eloquent\Collection|array
    {
        $post = Post::create([
            'description' => $request->post('description'),
        ]);

        foreach ($request->file('gallery') as $file) {
            $post->gallery()->create([
                'url' => $file->store('posts', 'public'),
            ]);

        }
        return $post->toArray();
    }

    public function storeLike(int $id): \Illuminate\Http\JsonResponse
    {
        Post::findOrFail($id)->increment('likes');

        return response()->json(['success' => true]);
    }

    public function deleteLike(int $id): \Illuminate\Http\JsonResponse
    {
        Post::findOrFail($id)->decrement('likes');

        return response()->json(['success' => true]);
    }
}
