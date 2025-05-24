<?php

namespace Modules\Influencer\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TwitchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule =  [
            "user_name"        => "nullable|max:255",
            "account_id"      => "nullable|string|max:255" ,
            "influencer_id"         => "required|exists:influencers,id",
            "workers"        => "nullable|array" ,
            "worker.*"      => "required|exists:users,id",
            "status"     => "sometimes",

        ];


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
}
