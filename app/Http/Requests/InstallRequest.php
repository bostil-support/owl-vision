<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallRequest extends FormRequest
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
        $rules = [];
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'db_host'        => 'required|string',
                    'db_name'        => 'required|string',
                    'db_user'        => 'required|string',
                    'db_password'    => 'string|nullable',
                    'admin_name'     => 'required|string',
                    'admin_email'    => 'required|email',
                    'admin_password' => 'required|string|min:8|confirmed',
                ];
                break;
            default:
                break;
        };

        return $rules;
    }

}
