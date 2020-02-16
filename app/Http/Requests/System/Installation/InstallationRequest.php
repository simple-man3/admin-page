<?php

namespace App\Http\Requests\System\Installation;

use Illuminate\Foundation\Http\FormRequest;

class InstallationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'db_host'    => 'required',
            'db_port'    => 'required',
            'db_database'    => 'required',
            'db_username'    => 'required',
            'db_password'    => 'required',
        ];
    }
}
