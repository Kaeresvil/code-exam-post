<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      
        return [
            'title' => ['required','string','max:255',],
            'body' => ['nullable', 'string'],
            'user_id' => ['required', 'exists:users,id'],
            
        ];
    }

    public function messages(): array
{
    return [
        'title.required' => 'The Post title is required.',
        'title.string' => 'The Post title must be a string.',
        'title.max' => 'The Post title must not exceed 255 characters.',

        'body.string' => 'The body must be a valid string.',

        'user_id.required' => 'Please select a category.',
        'user_id.exists' => 'The selected category does not exist.',

       
    ];
}
    
}
