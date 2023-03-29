<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
        'purchase_day' => ['required', 'date'],
        'title' => ['required', 'max:20'],
        'price' => ['required', 'numeric'],
        'memo' => ['max:255'],
        ];
    }
}
