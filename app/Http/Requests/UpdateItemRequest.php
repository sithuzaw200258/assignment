<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            "name" => "bail|required|min:3|unique:items,name,{$this->item->id}",
            "price" => "required|integer|not_in:0",
            "category" => "required|exists:categories,id",
            "description" =>"required|min:10",
            "condition" => "nullable",
            "type" => "nullable",
            "photo" => "nullable|mimes:png,jpg,jpeg|file|max:5000",
            "owner_name" =>"required|min:2|max:30",
            "phone" => "nullable|numeric|digits_between:6,11",
            "address" => "nullable|min:3|max:500"
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'item name',
        ];
    }
}
