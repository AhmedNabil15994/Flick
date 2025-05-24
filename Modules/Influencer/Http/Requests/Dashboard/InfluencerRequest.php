<?php

namespace Modules\Influencer\Http\Requests\Dashboard;

use Illuminate\Validation\Rule;
use Modules\Influencer\Enum\GenderType;
use Illuminate\Foundation\Http\FormRequest;

class InfluencerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule =  [
            "name"        => "required",
            "name.*"      => "required|string|max:255" ,
            "bio"         => "nullable",
            "email"        => "nullable|email|unique:influencers,email" ,
            "phone_code"   => "required",
            'mobile'     => [
                'required',"numeric","digits_between:6,15",
                 Rule::unique("influencers", "mobile")
                 ->where("phone_code", $this->phone_code)
             ],            "website_url"  => "nullable|url" ,
            "socials"     => "nullable|array",
            "birth_date"  =>"nullable|date",
            "gender"      => "nullable|in:".implode(",", GenderType::getConstList()),
            "country_id" => "required|exists:countries,id",
            "nationality_id" => "nullable|exists:countries,id",
            "state_id" => "nullable|exists:states,id",
            "city_id" => "nullable|exists:cities,id",
            "socials.*"   => "nullable|url" ,
            "status"     => "sometimes",
            "tags" => "sometimes|array",
            "tags.*"=> "sometimes|exists:tags,id"
        ];
        if (strtolower($this->getMethod()) == "put") {
            $rule["email"]  .= ",{$this->influencer},id" ;
            $rule["mobile"][3]  =   Rule::unique("influencers", "mobile")
            ->ignore($this->influencer)
            ->where("phone_code", $this->phone_code);
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
}
