<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;

class CategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $rows = Category::paginate();

        $meta = [
            'total' => $rows->total(),
            'current_page' => $rows->currentPage(),
            'last_page' => $rows->lastPage(),
            'per_page' => $rows->perPage(),
            'path' => $rows->path(),
        ];

        return $this->response->setCode(200)
            ->setData($rows->items())
            ->setMeta($meta)->respond();
    }

    public function show($id)
    {
        $row = Category::findOrfail($id);

        return $this->response->setCode(200)->setData($row)
            ->setMeta(['id' => $id])->respond();
    }
}
