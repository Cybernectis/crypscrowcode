<?php

namespace App\Http\Requests\Backend\Auth\Exchange;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'api_name' => 'required|max:191',
            'token_code' => "required",
            'currency' => "required",
        ];
    }
}
