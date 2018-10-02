<?php

namespace App\Http\Requests\Backend\Auth\Localcoins;

use Illuminate\Foundation\Http\FormRequest;

class LocalcoinRequest extends FormRequest
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
            'name' => 'required|max:191',
            'short_name' => "required",
            'creator_percentage'                    => "required",
            'taker_percentage'              => "required",
            'unit_name'                    => "required",
            'unit_value'    =>"required"
        ];
    }
}
