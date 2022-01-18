<?php

namespace App\Http\Requests\Post;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => [
                'max:255',
                Rule::unique('posts')->ignore($this->post, 'id')
            ],
            'category_id' => 'integer',
            'image' => 'image|mimes:jpg,png,jpeg'
        ];
    }
}
