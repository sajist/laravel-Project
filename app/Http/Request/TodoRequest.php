<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class TodoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'title' => 'required|string|min:5|max:50|unique:App\Models\Todo',
            'slug' => 'required|string|min:5|max:50',
            'description' => 'required|string|min:20|max:255'
        ];
    }
}