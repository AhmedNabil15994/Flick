<?php

namespace Modules\User\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'package_id'       => 'sometimes|exists:packages,id',
            "start_at"         => "sometimes|date",
            "end_at"           => "sometimes|date|after:start_at",
            "price"            => "sometimes|numeric|min:0"
            
        ];

        if (strtolower($this->getMethod()) == "put") {

        }
        return $rule;
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
