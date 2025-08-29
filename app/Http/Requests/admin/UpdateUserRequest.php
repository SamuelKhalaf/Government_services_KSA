<?php

namespace App\Http\Requests\admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'               => ['required','string','max:100','min:3'],
            'email'              => ['required','email','unique:users,email,' . $this->route('user')],
            'phone_number'       => ['required','string','max:20','min:11','unique:users,phone_number,' . $this->route('user')],
            'password'           => ['nullable','string','min:6','confirmed'],
            'role'               => ['required', 'exists:roles,name'],
            'national_id'        => ['nullable','string','max:20','unique:users,national_id,' . $this->route('user')],
            'status'             => ['required','in:active,inactive'],
            'preferred_language' => ['required','in:ar,en'],
            'address'            => ['nullable','string','max:500'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
