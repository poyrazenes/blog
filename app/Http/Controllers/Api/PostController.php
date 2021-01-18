<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $posts = Post::paginate();

        $meta = [
            'total' => $posts->total(),
            'current_page' => $posts->currentPage(),
            'last_page' => $posts->lastPage(),
            'per_page' => $posts->perPage(),
            'path' => $posts->path(),
        ];

        return $this->response->setCode(200)
            ->setData($posts->items())
            ->setMeta($meta)->respond();
    }

    public function store(PostRequest $request)
    {
        $user = auth()->user();

        $data = $request->validated();
        $data['user_id'] = $user->id;

        Post::create($data);

        return $this->response->setCode(201)->respond();
    }

    public function show($id)
    {
        $post = Post::findOrfail($id);

        return $this->response->setCode(200)->setData($post)
            ->setMeta(['id' => $id])->respond();
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrfail($id);

        $data = $request->validated();

        $post->update($data);

        return $this->response->setCode(204)->respond();
    }

    public function destroy($id)
    {
        $post = Post::findOrfail($id);

        $post->delete();

        return $this->response->setCode(204)->respond();
    }
}
