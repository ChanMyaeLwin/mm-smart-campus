<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization is handled by middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|exists:users,id',
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'date_of_birth' => 'sometimes|date|before:today',
            'gender' => 'sometimes|in:male,female,other',
            'address' => 'sometimes|string|max:1000',
            'phone_number' => 'sometimes|string|max:20',
            'enrollment_date' => 'sometimes|date|before_or_equal:today',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.exists' => 'The selected user does not exist.',
            'date_of_birth.before' => 'The date of birth must be before today.',
            'gender.in' => 'The gender must be male, female, or other.',
            'enrollment_date.before_or_equal' => 'The enrollment date cannot be in the future.',
        ];
    }
}