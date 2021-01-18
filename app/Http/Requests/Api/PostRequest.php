<?php

namespace App\Http\Requests\Api;

use App\Support\Response\Api\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:250',
            'content' => 'required',
            'status' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'Kategori ID',
            'title' => 'Başlık',
            'content' => 'İçerik',
            'status' => 'Durum',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new Response(
            422,
            'İstek datası doğrulamadan geçemedi!',
            (new ValidationException($validator))->errors()
        );

        throw new HttpResponseException($response->respond());
    }
}
