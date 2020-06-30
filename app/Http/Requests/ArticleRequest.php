<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class ArticleRequest extends FormRequest
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
            'title' => 'required',
            'body' => 'required',
            'except' => 'required',
            'tags' => 'exists:tags,id',
            'image' => 'string'
        ];
    }

    public function messages()
    {
        return [
            "image.string" => "Please Upload Image"
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->image) {
                if (!Storage::exists($this->image)) {
                    $validator->errors()->add('image', 'Please Upload Image');
                }
            }
        });
    }
}
