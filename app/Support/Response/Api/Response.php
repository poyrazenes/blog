<?php

namespace App\Support\Response\Api;

use Illuminate\Http\JsonResponse;

class Response
{
    private $response = null;

    /**
     * Response constructor.
     * @param int $code
     * @param string $message
     * @param $data
     * @param $meta
     */
    public function __construct(
        int $code = 200,
        string $message = 'İşlem Başarılı.',
        $data = null,
        $meta = null
    )
    {
        $this->response = new \stdClass();

        $this->response->code = $code;
        $this->response->message = $message;
        $this->response->data = $data;
        $this->response->meta = $meta;
    }

    public function setCode(int $code): Response
    {
        $this->response->code = $code;
        return $this;
    }

    public function setMessage(string $message): Response
    {
        $this->response->message = $message;
        return $this;
    }

    public function setData($data): Response
    {
        $this->response->data = $data;
        return $this;
    }

    public function setMeta($meta): Response
    {
        $this->response->meta = $meta;
        return $this;
    }

    public function respond(): JsonResponse
    {
        return response()->json(
            $this->response,
            $this->response->code
        );
    }
}
