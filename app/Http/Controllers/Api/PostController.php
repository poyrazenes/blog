<?php

namespace App\Http\Controllers\Api;

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

    public function store(Request $request)
    {
        return $this->response->setCode(201)->respond();
    }

    public function show($id)
    {
        $post = Post::findOrfail($id);

        return $this->response->setCode(200)->setData($post)
            ->setMeta(['id' => $id])->respond();
    }

    public function update(Request $request, $id)
    {
        return $this->response->setCode(204)->respond();
    }

    public function destroy($id)
    {
        return $this->response->setCode(200)->respond();
    }
}
