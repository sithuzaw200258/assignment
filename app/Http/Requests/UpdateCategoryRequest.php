<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "bail|required|min:3|unique:categories,title,{$this->category->id}",
            "photo" => "nullable|file|mimes:jpg,jpeg,png|max:5000",
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'category',
        ];
    }
}
