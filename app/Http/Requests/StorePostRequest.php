<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $route_roles = ['admin', 'moderator', 'posts.create'];

        // Check if the user has the 'create-post' permission

        $user_roles = explode(',', $this->user()->roles);

        $has_role = array_intersect($route_roles, $user_roles);

        return count($has_role) > 0;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:10|max:255',
            'body' => ['required', 'min:50', 'max:255'],
            'post_status_id' => 'required|integer|exists:post_statuses,id',
        ];
    }

    public function messages(): array
    {

        return [
            'title.required' => 'لابد من كتابة عنوان للمقال',
            'title.min' => 'يجب ان يكون عنوان المقال اكثر من 10 حروف',
            'title.max' => 'يجب ان يكون عنوان المقال اقل من 255 حروف',
            'body.required' => 'لابد من كتابة محتوى للمقال',
            'body.min' => 'يجب ان يكون محتوى المقال اكثر من 50 حروف',
            'body.max' => 'يجب ان يكون محتوى المقال اقل من 255 حروف',
            'post_status_id.required' => 'لابد من اختيار حالة المقال',
            'post_status_id.integer' => 'يجب ان يكون حالة المقال رقم',
            'post_status_id.exists' => 'حالة المقال غير مقبولة',
        ];
    }

}
