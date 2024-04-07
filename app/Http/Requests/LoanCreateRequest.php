<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanCreateRequest extends FormRequest
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
     * @return array<string>
     */
    public function rules(): array
    {
        return [
            'loan_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'loan_term' => 'required|numeric|min:1'
        ];
    }

}
