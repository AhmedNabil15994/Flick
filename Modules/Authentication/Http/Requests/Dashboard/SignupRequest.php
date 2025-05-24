<?php

namespace Modules\Authentication\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class SignupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // public function rules()
    // {
    //     return [
    //         'name'  => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
    //         'phone' => ['required', 'numeric', 'unique:clients,mobile'],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ];
    // }
    public function rules()
    {
        dd('tst');
        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'name'            => 'required',
                  'mobile'          => 'required|numeric|unique:clients,mobile|digits_between:8,11',
                  'email'           => 'required|unique:clients,email',
                  'password'        => 'required|min:6|same:confirm_password',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'name'            => 'required',
                    'mobile'          => 'required|numeric|digits_between:8,11|unique:clients,mobile,'.$this->client.'',
                    'email'           => 'required|unique:clients,email,'.$this->client.'',
                    'password'        => 'nullable|min:6|same:confirm_password',
                ];
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {

        $v = [
            'name.required'           => __('user::dashboard.users.validation.name.required'),
            'email.required'          => __('user::dashboard.users.validation.email.required'),
            'email.unique'            => __('user::dashboard.users.validation.email.unique'),
            'mobile.required'         => __('user::dashboard.users.validation.mobile.required'),
            'mobile.unique'           => __('user::dashboard.users.validation.mobile.unique'),
            'mobile.numeric'          => __('user::dashboard.users.validation.mobile.numeric'),
            'mobile.digits_between'   => __('user::dashboard.users.validation.mobile.digits_between'),
            'password.required'       => __('user::dashboard.users.validation.password.required'),
            'password.min'            => __('user::dashboard.users.validation.password.min'),
            'password.same'           => __('user::dashboard.users.validation.password.same'),
        ];


        return $v;
    }
}
