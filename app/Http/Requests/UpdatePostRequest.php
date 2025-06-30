<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Exception;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    // public function failedAuthorization()
    // {

    //     throw new Exception('You are not ...', 403);
    // }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['min:10'],
            'body' => 'required|min:50|max:255',
            'post_status_id' => 'integer|exists:post_statuses,id',
        ];
    }
}
